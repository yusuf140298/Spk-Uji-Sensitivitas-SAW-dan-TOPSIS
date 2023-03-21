<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class TopsisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$kriteria = Criteria::all();
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
		
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				$bagi[$value1->id][$value->id]  = pow($value1->pivot->nilai,2);
				$bagi2[$value1->id][$value->id]  = $value1->pivot->nilai;
			}
		}

		foreach ($bagi as $key => $value) {
			$p[$key] = array_sum($value);
		}

		foreach ($p as $key => $value) {
			$pembagi[$key] = sqrt($value);
		}
		// dd($bagi2);
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
						$normalisasi[$value->id][$value1->id]  = ($value1->pivot->nilai/$value2);
						
					}
				}
			}
		}
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($pembagi as $key2 => $value2) {
					if ($value1->id == $key2) {
						$norbot[$value1->id][$value->id] = ($value1->pivot->nilai/$value2) * ($value1->bobot/$bsum);
					}						
				}
			}
		}
		foreach ($MyScore as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($pembagi as $key2 => $value2) {
					if ($value1->id == $key2) {
						$norbot1[$value->id][$value1->id]  = ($value1->pivot->nilai/$value2) * ($value1->bobot/$bsum);
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
		$topsisr = collect($preference)->sortDesc();
		$ranktopsis = $topsisr->toArray();
		// dd($max);
		return view ('TopsisPage', ['MyData' => Receiver::Search()->paginate(10)->withQueryString(),
			'MySubKriteria' => Subcriteria::all(),
			'MyScore' => $MyScore,
			'bsum' => $bsum,
			'pembagi' => $pembagi,
			'decimal' => $decimal,
			'sumdecimal' => $sumdecimal,
			'normalisasi' => $normalisasi,
			'norbot1' => $norbot1,
			'max' => $max,
			'min' => $min,
			'positive' => $positive,
			'negative' => $negative,
			'preference' => $preference,
			'mypreference' => $ranktopsis,
			'ranktopsis' => $ranktopsis],
			['MyKriteria' => Criteria::all()],
		);
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
