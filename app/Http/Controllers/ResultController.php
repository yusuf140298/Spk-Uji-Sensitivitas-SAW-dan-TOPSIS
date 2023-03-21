<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Score;
use Illuminate\Support\Facades\DB;
use App\Support\Collection;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$kriteria = Criteria::all();
		$subkriteria = Subcriteria::all();
		$bsum = DB::table('criterias')->sum('bobot');
		$Data = Receiver::all();
		$Score = Score::all();
		$MyScore = Receiver::all();
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				if ($value1->pivot->nilai == 0) {
					return redirect('/')->with('fail', 'Silahkan Periksa Apakah Data Sudah Lengkap?');
				}
			}
		}

		foreach ($kriteria as $key => $value) {
				$decimal[$value->id] = ($value->bobot/$bsum);
		}
		$sumdecimal = array_sum($decimal);
		
		// dd($decimal);
																			//TOPSIS
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				$bagi[$value1->id][$value->id]  = pow($value1->pivot->nilai,2);
			}
		}

		foreach ($bagi as $key => $value) {
			$p[$key] = array_sum($value);
		}

		foreach ($p as $key => $value) {
			$pembagi[$key] = sqrt($value);
		}
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($pembagi as $key2 => $value2) {
					if ($value1->id == $key2) {
						$normal[$value1->id][$value->id]  = ($value1->pivot->nilai/$value2);
						
					}
				}
			}
		}

		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($pembagi as $key2 => $value2) {
					if ($value1->id == $key2) {
						$norbot[$value1->id][$value->id] = ($value1->pivot->nilai/$value2) * ($value1->bobot);
					}						
				}
			}
		}
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($pembagi as $key2 => $value2) {
					if ($value1->id == $key2) {
						$norbot1[$value->id][$value1->id]  = ($value1->pivot->nilai/$value2) * ($value1->bobot);
					}						
				}
			}
		}
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($norbot as $key2 => $value2) {
					if ($value1->id == $key2) {
						if ($value1->jenis == 'Benefit') {
							$max[$value1->id] = max($value2);
							$min[$value1->id] = min($value2);
							
						}elseif ($value1->jenis == 'Cost') {
							$max[$value1->id] = min($value2);
							$min[$value1->id] = max($value2);
							// $max[$value1->id] = min($value2);
							// $min[$value1->id] = max($value2);
						}
						
					}						
				}
			}
		}
		
		foreach ($max as $key2 => $value2) {
			foreach ($norbot1 as $key3 => $value3) {
				foreach ($value3 as $key4 => $value4) {
					if ($key2 == $key4) {
						$pos[$key3][$key4] = pow(($value2-$value4),2);
					}				
				}
			}
		}
		foreach ($pos as $key => $value) {
			$posi[$key] = array_sum($value);
		}
		foreach ($posi as $key => $value) {
			$positive[$key] = sqrt($value);
		}

		foreach ($min as $key2 => $value2) {
			foreach ($norbot1 as $key3 => $value3) {
				foreach ($value3 as $key4 => $value4) {
					if ($key2 == $key4) {
						$neg[$key3][$key4] = pow(($value4-$value2),2);
					}				
				}
			}
		}
		
		foreach ($neg as $key => $value) {
			$nega[$key] = array_sum($value);
		}
		foreach ($nega as $key => $value) {
			$negative[$key] = sqrt($value);
		}
		foreach ($positive as $key => $value) {
			foreach ($negative as $key1 => $value1) {
				if ($key == $key1) {
					if ($value1 == 0) {
						$preference[$key] = "($value1 + $value)/$value1";
					}elseif($value1 != 0) {
						$preference[$key] = round((($value1 + $value)/$value1),2);
					}
				}
			}
		}
		// dd($preference);
		
		$preferencemax = max($preference); 
		
		// dd($preferencemax);
																				//SAW
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				$bobot[$key1]  = ($value1->bobot)/$bsum;
			}
		}
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				$saw[$value1->id][$value->id]  = ($value1->pivot->nilai);
			}
		}
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($saw as $key2 => $value2) {
					if ($value1->id == $key2) {
						if ($value1->jenis == 'Benefit') {
							$bagi[$value1->id]  = max($value2);
						}elseif ($value1->jenis == 'Cost') {
							$bagi[$value1->id]  = min($value2);
						}
					}
				}
			}
		}
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($saw as $key2 => $value2) {
					if ($value1->id == $key2) {
						if ($value1->jenis == 'Benefit') {
							$sawnormal[$value->id][$key1] = ($value1->pivot->nilai)/max($value2);
						}elseif ($value1->jenis == 'Cost') {
							$sawnormal[$value->id][$key1] = min($value2)/($value1->pivot->nilai);
						}
					}
				}
			}
		}
		
		foreach ($sawnormal as $key => $value) {
			foreach ($value as $key1 => $value1) {
				foreach ($bobot as $key2 => $value2) {
					if ($key1 == $key2) {
						$sawpref[$key][$key1] = $value2*$value1;
					}
				}
			}
		}
		// dd($sawpref);
		foreach ($sawpref as $key => $value) {
			$sawpreference[$key] = round(array_sum($value),2); 
		}
		$sawpreferencemax = max($sawpreference);
		// dd($sawpreferencemax);
																//sensitivitas

		foreach ($kriteria as $key => $value) {
			foreach ($MyScore as $key1 => $value1) {
				foreach ($value1->criterias as $key2 => $value2) {
					if ($key2 == $key) {
						$sensi[$key2][$key] = (($value->bobot)/$bsum)+0.5;
						$sensi1[$key2][$key] = (($value->bobot)/$bsum)+1;
					}elseif ($key2 != $key) {
						$sensi[$key2][$key] = ($value->bobot)/$bsum;
						$sensi1[$key2][$key] = ($value->bobot)/$bsum;
					}
				}
			}
		}
		// dd($sensi);
		foreach ($sensi as $key => $value) {
			foreach ($pembagi as $key1 => $value1) {
				foreach ($MyScore as $key2 => $value2) {
					foreach ($value2->criterias as $key3 => $value3) {
						if ($value3->id == $key1) {
							if ($key3 == $key) {
								$sensinorbot[$key][$value2->id][$key1] = ($value3->pivot->nilai/$value1)*(($value3->bobot/$bsum)+0.5);
								$sensinorbot1[$key][$value2->id][$key1] = ($value3->pivot->nilai/$value1)*(($value3->bobot/$bsum)+1);
							}elseif ($key3 != $key) {
								$sensinorbot[$key][$value2->id][$key1] = ($value3->pivot->nilai/$value1)*($value3->bobot/$bsum);
								$sensinorbot1[$key][$value2->id][$key1] = ($value3->pivot->nilai/$value1)*($value3->bobot/$bsum);
							}
						}
					}
				}
			}
		}
		
		foreach ($sensi as $key => $value) {
			foreach ($pembagi as $key1 => $value1) {
				foreach ($MyScore as $key2 => $value2) {
					foreach ($value2->criterias as $key3 => $value3) {
						if ($value3->id == $key1) {
							if ($key3 == $key) {
								$sensitivnorbot[$key][$key1][$value2->id] = ($value3->pivot->nilai/$value1)*(($value3->bobot/$bsum)+0.5);
								$sensitivnorbot1[$key][$key1][$value2->id] = ($value3->pivot->nilai/$value1)*(($value3->bobot/$bsum)+1);
							}elseif ($key3 != $key) {
								$sensitivnorbot[$key][$key1][$value2->id] = ($value3->pivot->nilai/$value1)*($value3->bobot/$bsum);
								$sensitivnorbot1[$key][$key1][$value2->id] = ($value3->pivot->nilai/$value1)*($value3->bobot/$bsum);
							}
						}
					}
				}
			}
		}
		// dd($sensitivnorbot);
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($sensitivnorbot as $key2 => $value2) {
					foreach ($value2 as $key3 => $value3) {
						if ($key3 == $value1->id) {
							if ($value1->jenis == 'Benefit') {
								$sensimax[$key2][$key3] = max($value3);
								$sensimin[$key2][$key3] = min($value3);
							}elseif ($value1->jenis == 'Cost') {
								$sensimax[$key2][$key3] = min($value3);
								$sensimin[$key2][$key3] = max($value3);
							}
						}
					}						
				}
			}
		}
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($sensitivnorbot1 as $key2 => $value2) {
					foreach ($value2 as $key3 => $value3) {
						if ($key3 == $value1->id) {
							if ($value1->jenis == 'Benefit') {
								$sensimax1[$key2][$key3] = max($value3);
								$sensimin1[$key2][$key3] = min($value3);
							}elseif ($value1->jenis == 'Cost') {
								$sensimax1[$key2][$key3] = min($value3);
								$sensimin1[$key2][$key3] = max($value3);
							}
						}
					}						
				}
			}
		}

		foreach ($sensimax as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sensinorbot as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						foreach ($value4 as $key5 => $value5) {
							if ($key == $key3) {
								if ($key5 == $key1) {
									$sensipos[$key][$key4][$key1] = pow(($value1-$value5),2);
								}
							}
						}
					}
				}
			}
		}
		foreach ($sensipos as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensiposi[$key][$key1] = array_sum($value1);
			}
		}
		foreach ($sensiposi as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensipositive[$key][$key1] = sqrt($value1);
			}
		}

		foreach ($sensimax1 as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sensinorbot1 as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						foreach ($value4 as $key5 => $value5) {
							if ($key == $key3) {
								if ($key5 == $key1) {
									$sensipos1[$key][$key4][$key1] = pow(($value1-$value5),2);
								}
							}
						}
					}
				}
			}
		}
		foreach ($sensipos1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensiposi1[$key][$key1] = array_sum($value1);
			}
		}
		foreach ($sensiposi1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensipositive1[$key][$key1] = sqrt($value1);
			}
		}

		foreach ($sensimin as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sensinorbot as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						foreach ($value4 as $key5 => $value5) {
							if ($key == $key3) {
								if ($key5 == $key1) {
									$sensineg[$key][$key4][$key1] = pow(($value1-$value5),2);
								}
							}
						}
					}
				}
			}
		}
		foreach ($sensineg as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensinega[$key][$key1] = array_sum($value1);
			}
		}
		foreach ($sensinega as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensinegative[$key][$key1] = sqrt($value1);
			}
		}

		foreach ($sensimin1 as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sensinorbot1 as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						foreach ($value4 as $key5 => $value5) {
							if ($key == $key3) {
								if ($key5 == $key1) {
									$sensineg1[$key][$key4][$key1] = pow(($value1-$value5),2);
								}
							}
						}
					}
				}
			}
		}
		foreach ($sensineg1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensinega1[$key][$key1] = array_sum($value1);
			}
		}
		foreach ($sensinega1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensinegative1[$key][$key1] = sqrt($value1);
			}
		}

		foreach ($sensipositive as $key => $value) {
			foreach ($value as $key1 => $value1) {
				foreach ($sensinegative as $key2 => $value2) {
					foreach ($value2 as $key3 => $value3) {
						if ($key == $key2) {
							if ($key1 == $key3) {
								if ($value3 == 0) {
									$sensipreference[$key][$key3] = "($value3+$value1)/$value3";
								}elseif($value1 != 0) {
									$sensipreference[$key][$key3] = round((($value3+$value1)/$value3),2);
								}
							}
						}
					}
				}
			}
		}

		foreach ($sensipositive1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				foreach ($sensinegative1 as $key2 => $value2) {
					foreach ($value2 as $key3 => $value3) {
						if ($key == $key2) {
							if ($key1 == $key3) {
								if ($value3 == 0) {
									$sensipreference1[$key][$key3] = "($value3+$value1)/$value3";
								}elseif($value1 != 0) {
									$sensipreference1[$key][$key3] = round((($value3+$value1)/$value3),2);
								}
							}
						}
					}
				}
			}
		}
		foreach ($sensipreference as $key => $value) {
			$sensipreferencemax[$key] = max($value); 
		}
		
		foreach ($sensipreference1 as $key => $value) {
			$sensipreferencemax1[$key] = max($value); 
		}
		// dd($sensipreference);
																													//

		foreach ($sensi as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sawnormal as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						if ($key1 == $key4) {
							$sensisawpref[$key][$key3][$key4] = ($value1*$value4);
						}
					}
				}
			}
		}
		foreach ($sensi1 as $key => $value2) {
			foreach ($value2 as $key1 => $value1) {
				foreach ($sawnormal as $key3 => $value3) {
					foreach ($value3 as $key4 => $value4) {
						if ($key1 == $key4) {
							$sensisawpref1[$key][$key3][$key4] = $value1*$value4;
						}
					}
				}
			}
		}

		foreach ($sensisawpref as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensisawpreference[$key][$key1] = round(array_sum($value1),2); 
			}
		}
		foreach ($sensisawpref1 as $key => $value) {
			foreach ($value as $key1 => $value1) {
				$sensisawpreference1[$key][$key1] = round(array_sum($value1),2); 
			}
		}

		foreach ($sensisawpreference as $key => $value) {
			$sensisawpreferencemax[$key] = max($value); 
		}
		
		foreach ($sensisawpreferencemax as $key => $value) {
			$precentagesensisawpreference[$key] = ($value-$sawpreferencemax) .'%'; 
		}

		foreach ($sensisawpreference1 as $key => $value) {
			$sensisawpreferencemax1[$key] = max($value); 
		}
		
		foreach ($sensisawpreferencemax1 as $key => $value) {
			$precentagesensisawpreference1[$key] = ($value-$sawpreferencemax) .'%'; 
		}

		foreach ($sensipreference as $key => $value) {
			$sensipreferencemax[$key] = max($value); 
		}
		foreach ($sensipreferencemax as $key => $value) {
			$precentagesensipreference[$key] = ($value-$preferencemax) .'%'; 
		}

		foreach ($sensipreference1 as $key => $value) {
			$sensipreferencemax1[$key] = max($value); 
		}
		foreach ($sensipreferencemax1 as $key => $value) {
			$precentagesensipreference1[$key] = ($value-$preferencemax) .'%'; 
		}
		foreach ($kriteria as $key => $value) {
			foreach ($MyScore as $key1 => $value1) {
				foreach ($value1->criterias as $key2 => $value2) {
					if ($key2 == $key) {
						$sensitivity[$key] = "$value->kriteria + 0.5";
						$sensitivity1[$key] = "$value->kriteria + 1";
					}
				}
			}
		}
		$sensitiv = array_merge($sensitivity,$sensitivity1);
		$sensitivsaw = array_merge($precentagesensisawpreference,$precentagesensisawpreference1);
		$sensitivtopsis = array_merge($precentagesensipreference,$precentagesensipreference1);
		$sumsensitivsaw = array_sum($sensitivsaw);
		$sumsensitivtopsis = array_sum($sensitivtopsis);

		if ($request->filter != null) {
			$i = $request->filter;
		}else {
			$i = Receiver::count();
		}
		$sawr = collect($sawpreference)->sortDesc()->take($i)->paginate(10)->withQueryString();
		$ranksaw = $sawr->toArray();

		$topsisr = collect($preference)->sortDesc()->take($i)->paginate(10)->withQueryString();
		$ranktopsis = $topsisr->toArray();
		$sumdataku = Receiver::count();
		// dd($ranktopsis);
		if ($sumsensitivsaw > $sumsensitivtopsis) {
			return view ('ResultPage', ['MyData' => Receiver::Search()->get()],
						['MyKriteria' => Criteria::all(),
						'MySubKriteria' => Subcriteria::all(),
						'MyPage' => 'Metode SAW',
						'MyScore' => $MyScore,
						'preference' => $ranksaw,
						'mypreference' => $ranksaw,
						'sumdataku' => $sumdataku,
						'filter' => $i
						]);
		}elseif ($sumsensitivtopsis > $sumsensitivsaw) {
			return view ('ResultPage', ['MyData' => Receiver::Search()->get()],
						['MyKriteria' => Criteria::all(),
						'MySubKriteria' => Subcriteria::all(),
						'MyPage' => 'Metode TOPSIS',
						'MyScore' => $MyScore,
						'preference' => $topsisr,
						'mypreference' => $ranktopsis,
						'sumdataku' => $sumdataku,
						'filter' => $i
						]);
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
