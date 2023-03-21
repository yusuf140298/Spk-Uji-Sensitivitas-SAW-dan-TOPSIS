<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Models\Subcriteria;
use App\Models\Score;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('SubCriteriaPage', ['MyKriteria' => Criteria::all(),
								'MySubKriteria' => Subcriteria::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $MyRequest = $request->validate([
						'criteria_id' => 'required',
						'keterangan' => 'required',
						'bobotsub' => 'required|numeric'
					]);
		$val = Subcriteria::where('criteria_id', $request->criteria_id)->get();
		foreach ($val as $key => $value) {
			if ($value->bobotsub == $request->bobotsub) {
				return redirect('SubCriteriaPage')->with('fail', 'Data Gagal ditambahkan, Pastikan Nilai Tidak Sama');
			}
		}
		Subcriteria::create($MyRequest);
		return redirect('SubCriteriaPage')->with('succes', 'Data Berhasil ditambahkan');
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
			'criteria_id' => 'required',
			'keterangan' => 'required',
			'bobotsub' => 'required|numeric',
		]);

		$val = Subcriteria::where('criteria_id', $request->criteria_id)->get();
		foreach ($val as $key => $value) {
			if ($value->bobotsub == $request->bobotsub) {
				return redirect('SubCriteriaPage')->with('fail', 'Data Gagal diperbarui, Pastikan Nilai Tidak Sama');
			}
		}

		$match = [
			'criteria_id' => $request->criteria_id,
			'nilai' => $request->mybot
		];

		$updatesub = Score::where($match);
		// dd($updatesub);
		$updatesub->update(['nilai' => $request->bobotsub]);
		Subcriteria::where('id', $id)->update($MyRequest);
		return redirect('/SubCriteriaPage')->with('succes', 'Data Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {	
		$nilai = array();
		$match = [
			'criteria_id' => $request->criteria_id,
			'nilai' => $request->mybot
		];
		$deletesub = Score::where($match);
		$deletesub->update(['nilai' => 0]);
		Subcriteria::destroy($id);
		return redirect('/SubCriteriaPage')->with('succes', 'Data Berhasil dihapus');
    }
}
