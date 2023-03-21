<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $myitem = User::where('name', 'LIKE', '%' . $request->search . '%')
                ->orWhere('nip', 'LIKE', '%' . $request->search . '%')
                ->orWhere('created_at', 'LIKE', '%' . $request->search . '%')
                ->get();
        } else {
            $myitem = User::all();
        }
        $cari = $request->input('search');
        return view('RegisterPage', ['users' => $myitem,
							'roles' => Role::all()], 
							['myvalue' => $cari]);
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
		$validate = $request->validate([
			'nip' => 'required|numeric|unique:users|digits:16',
			'nama' => 'required',
			'password' => 'required|min:6',
			'level' => 'required',
		]);
		// dd($validate);
		User::create([
            'nip' => $request['nip'],
            'name' => $request['nama'],
            'role_id' => $request['level'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect('/RegisterPage')->with('succes', 'Berhasil Daftar User');
    
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
        $myvalidate = $request->validate([
			'nipup' => 'required|numeric|digits:16',
			'namaup' => 'required',
			'levelup' => 'required',
		]);
		$updata = User::where('id', $id)->update([
			'nip' => $request['nipup'],
            'name' => $request['namaup'],
            'role_id' => $request['levelup'],
		]);
		return redirect('/RegisterPage')->with('succes', 'Berhasil Ubah Data User');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$myDelete = User::destroy($id);
        return redirect('/RegisterPage')->with('succes', 'Berhasil Hapus User');
    }
}
