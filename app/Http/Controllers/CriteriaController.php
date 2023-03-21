<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receiver;
use App\Models\Criteria;
use App\Models\Subcriteria;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		return view('CriteriaPage', ['MyKriteria' => Criteria::Search()->paginate(10)->withQueryString()]);
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
						'kriteria' => 'required',
						'bobot' => 'required|numeric',
						'jenis' => 'required'
					]);
		// $myid = Receiver::get('id');
		
		// dd($myid);
		Criteria::create($MyRequest);
		return redirect('CriteriaPage')->with('succes', 'Data Berhasil ditambahkan');
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
			'kriteria' => 'required',
			'bobot' => 'required|numeric',
			'jenis' => 'required',
		]);
		Criteria::where('id', $id)->update($MyRequest);
		return redirect('/CriteriaPage')->with('succes', 'Data Berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {	
		$delete = Criteria::find($id);
		$deletesub = Subcriteria::where('criteria_id',$id);
		$deletesub->delete();
		$delete->receivers()->detach();
		$delete->receivers()->delete();
		Criteria::destroy($id);
		return redirect('CriteriaPage')->with('succes', 'Data Berhasil dihapus');
    }
}
