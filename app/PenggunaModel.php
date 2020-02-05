<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class PenggunaModel extends Model
{
    protected $table = 'users';
    protected $fillable = ['id','name','email','alamat','no_telp','role'];

    public function getAllDataPemilik(Request $request)
    {
        $data = DB::table('users')->orderby('name','asc')->where('role','0')->where('flag','1');

            if($request->get('search')!=null){
                
                $data = $data->Where(function ($query) use ($request) {
                    $query
                    ->where('users.name','like',"%".$request->get('search')."%");
               });
            }
        
            return $data = $data->paginate(20);

    }
}