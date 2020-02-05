<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\AdminModel;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $AdminModel;

    public function __construct(AdminModel $AdminModel)
    {
        $this->AdminModel = $AdminModel;
        $this->middleware('isAdmin');
    }

    public function index(Request $request)
    {
        $users = $this->AdminModel->getAllDataAdmin($request);
        
        return view('users.index', compact('users'))
        ->with('i',(request()->input('page', 1) - 1 ) * 20);
    }

    public function create()
    {
        return view('users.create');
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

        $dataAdmin = new AdminModel();
        $dataAdmin->name = $request->name;
        $dataAdmin->email = $request->email;
        $dataAdmin->password = Hash::make($request->password);
        $dataAdmin->alamat = $request->alamat;
        $dataAdmin->no_telp = $request->no_telp;
        $dataAdmin->role = 1;

        $dataAdmin->save();
        
        return redirect()->route('user.index')->withStatus(__('Data berhasil ditambahkan!'));
    }

    public function edit($id)
    {
        $user = AdminModel::where('id',$id)->where('role','1')->first();
        $tempID = auth()->user()->id;

        if($user == null)
        {
            return redirect()->route('user.index');
        }
        else
        {
            return view('users.edit', compact('user'));
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

        $dataAdmin = AdminModel::where('id',$id)->first();
        $dataAdmin->name = $request->name;
        $dataAdmin->email = $request->email;
        $dataAdmin->password = Hash::make($request->password);
        $dataAdmin->alamat = $request->alamat;
        $dataAdmin->no_telp = $request->no_telp;
        $dataAdmin->role = 1;

        $dataAdmin->save();

        return redirect()->route('user.index')->withStatus(__('Data berhasil diperbaharui!'));
    }

    public function destroy($id)
    {
        $dataAdmin = AdminModel::where('id',$id)->first();
        $dataAdmin->flag = 0;
        $dataAdmin->save();

        return redirect()->route('user.index')->withStatus(__('Data berhasil dihapus!'));
    }
}
