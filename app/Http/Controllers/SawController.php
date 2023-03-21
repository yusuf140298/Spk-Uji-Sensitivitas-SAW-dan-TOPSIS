<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Receiver;
use App\Models\Score;
use Illuminate\Support\Facades\DB;

class SawController extends Controller
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
		$sawr = collect($sawpreference)->sortDesc();
		$ranksaw = $sawr->toArray();
		return view ('SawPage', ['MyData' => Receiver::Search()->paginate(10)->withQueryString(),
		'MyKriteria' => Criteria::all(),
		'MySubKriteria' => Subcriteria::all(),
		'bsum' => $bsum,
		'decimal' => $decimal,
		'sumdecimal' => $sumdecimal,
		'sawnormal' => $sawnormal,
		'sawpreference' => $sawpreference,
		'ranksaw' => $ranksaw,
		'preference' => $ranksaw,
		'MyScore' => $MyScore],
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
