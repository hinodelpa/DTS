<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\PenggunaModel;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DealerController extends Controller
{
    private $PenggunaModel;

    public function __construct(PenggunaModel $PenggunaModel)
    {
        $this->PenggunaModel = $PenggunaModel;
        $this->middleware('isAdmin');
    }

    public function index(Request $request)
    {
        $users = $this->PenggunaModel->getAllDataPemilik($request);
        
        return view('dealer.index', compact('users'))
        ->with('i',(request()->input('page', 1) - 1 ) * 20);
    }

    public function create()
    {
        return view('dealer.create');
    }
    
    public function store(Request $request)
    {
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

        $dataPengguna = new PenggunaModel();
        $dataPengguna->name = $request->name;
        $dataPengguna->email = $request->email;
        $dataPengguna->password = Hash::make($request->password);
        $dataPengguna->group = $request->group;
        $dataPengguna->kode = $request->kode;
        $dataPengguna->alamat = $request->alamat;
        $dataPengguna->no_telp = $request->no_telp;
        $dataPengguna->role = 0;

        $dataPengguna->save();
        
        return redirect()->route('dealer.index')->withStatus(__('Data berhasil ditambahkan!'));
    }

    public function edit($id)
    {
        $user = PenggunaModel::where('id',$id)->where('role','0')->first();
        $tempID = auth()->user()->id;

        if($user == null)
        {
            return redirect()->route('dealer.index');
        }
        else
        {
            return view('dealer.edit', compact('user'));
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

        return redirect()->route('dealer.index')->withStatus(__('Data berhasil diperbaharui!'));
    }

    public function destroy($id)
    {
        $dataPengguna = PenggunaModel::where('id',$id)->first();
        $dataPengguna->flag = 0;
        $dataPengguna->save();

        return redirect()->route('dealer.index')->withStatus(__('Data berhasil dihapus!'));
    }

    public function getPengguna()
    {
        $data = $this->PenggunaModel->get();
        return json_encode($data);
    }
}
