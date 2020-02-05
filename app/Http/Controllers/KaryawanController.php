<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\KaryawanModel;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class KaryawanController extends Controller
{
    private $KaryawanModel;

    public function __construct(KaryawanModel $KaryawanModel)
    {
        $this->KaryawanModel = $KaryawanModel;
        $this->middleware('isAdmin');
    }

    public function index(Request $request)
    {
        $users = $this->KaryawanModel->getAllDataKaryawan($request);

        return view('karyawan.index', compact('users'))
        ->with('i',(request()->input('page', 1) - 1 ) * 20);
    }

    public function create()
    {
        $dealers = $this->KaryawanModel->getAllDealer();
        
        return view('karyawan.create', compact('dealers'));
    }
    
    public function store(Request $request)
    {
        /*
        $attributes = [
            'name' => 'name',
            'email' => 'email',
            'password' => 'password'
        ];
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], $attributes);
        */

        $dataKaryawan = new KaryawanModel();
        $dataKaryawan->hso_id = $request->hso_id;
        $dataKaryawan->honda_id = $request->honda_id;
        $dataKaryawan->dealer_id = $request->dealer_id;
        $dataKaryawan->tgl_lahir = $request->tgl_lahir;
        $dataKaryawan->jabatan = $request->jabatan;
        $dataKaryawan->nama = $request->nama;
        $dataKaryawan->alamat = $request->alamat;
        $dataKaryawan->no_telp = $request->no_telp;
        $dataKaryawan->flag = 1;
        $dataKaryawan->save();
        
        return redirect()->route('karyawan.index')->withStatus(__('Data berhasil ditambahkan!'));
    }

    public function edit($id)
    {
        $user = KaryawanModel::where('id',$id)->where('role','0')->first();
        $tempID = auth()->user()->id;

        if($user == null)
        {
            return redirect()->route('karyawan.index');
        }
        else
        {
            return view('karyawan.edit', compact('user'));
        }
    }

    public function update(Request $request, $id)
    {
        $attributes = [
            'name' => 'name',
            'email' => 'email',
            'password' => 'password'
        ];
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($id)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], $attributes);

        $dataPengguna = PenggunaModel::where('id',$id)->first();
        $dataPengguna->name = $request->name;
        $dataPengguna->email = $request->email;
        $dataPengguna->password = Hash::make($request->password);
        $dataPengguna->alamat = $request->alamat;
        $dataPengguna->no_telp = $request->no_telp;
        $dataPengguna->role = 0;
        $dataPengguna->group = $request->group;
        $dataPengguna->kode = $request->kode;
        $dataPengguna->save();

        return redirect()->route('karyawan.index')->withStatus(__('Data berhasil diperbaharui!'));
    }

    public function destroy($id)
    {
        $dataPengguna = KaryawanModel::where('id',$id)->first();
        $dataPengguna->flag = 0;
        $dataPengguna->save();

        return redirect()->route('karyawan.index')->withStatus(__('Data berhasil dihapus!'));
    }
}
