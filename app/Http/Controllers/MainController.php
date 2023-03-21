<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Criteria;
use App\Models\Score;
use App\Models\Subcriteria;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$MyScore = Receiver::with('criterias')->Search()->paginate(10)->withQueryString();
		$MyScore2 = Receiver::all();
		$MySubKriteria = Subcriteria::all();

		foreach ($MyScore2 as $key => $value) {
			foreach ($value->criterias as $key1 => $value1) {
				foreach ($MySubKriteria as $key2 => $value2) {
					if ($value1->id == $value2->criteria_id) {
						if ($value1->pivot->nilai == $value2->bobotsub) {
							$mydata[$value->nama][$value1->id] = $value2->keterangan;
						}elseif ($value1->pivot->nilai == 0) {
							$mydata[$value->nama][$value1->id] = 0;
						}
					}
				}
			}
		}
		// dd($mydata);
		$sumdataku = Receiver::count();
		return view('MainPage', [
			'MyKriteria' => Criteria::all(),
			'MySubKriteria' => Subcriteria::all(),
			'MyScore' => $MyScore,
			'sumdataku' => $sumdataku,
			'MyData' => Receiver::latest()->Search()->paginate(10)->withQueryString(),
		]);
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
    public function store(Request $request, Receiver $re)
    {
		$nilai = array();
		$MyRequest = $request->validate([
			'nik' => 'required|unique:receivers',
			'nama' => 'required',
			'alamat' => 'required',
			'rt' => 'required',
			'rw' => 'required',
		]);
		$receiver = receiver::create($MyRequest);

		foreach ($request->input('kriteria') as $key => $value) {
			array_push($nilai,  ['receiver_id' => $receiver->id,
							'criteria_id' => $key,
							'nilai' => $value,
							]);
		}
		DB::table('scores')->insert($nilai);
		return redirect('/')->with('succes', 'Data Berhasil ditambahkan');
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
		$MyRequest = $request->validate([
						'nik' => 'required',
						'nama' => 'required',
						'alamat' => 'required',
						'rt' => 'required',
						'rw' => 'required',
					]);
		$updata = Receiver::where('id', $id)->update($MyRequest);

		$myupdate = Receiver::find($id);
		
		$nilai = collect($request->input('kriteria', []))
		->map(function($mynilai){
			return ['nilai' => $mynilai];
		});
		// dd($nilai);
		$myupdate->criterias()->sync($nilai);

		return redirect('/')->with('succes', 'Data Berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$delete = Receiver::find($id);
		$myDelete = Receiver::destroy($id);
		$delete->criterias()->detach();
		$delete->criterias()->delete();
		return redirect('/')->with('succes', 'Data Berhasil dihapus');
    }
}
