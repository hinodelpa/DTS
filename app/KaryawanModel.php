<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class KaryawanModel extends Model
{
    protected $table = 'karyawan';
    protected $fillable = ['id','hso_id','honda_id','alamat','no_telp','tgl_lahir','nama','jabatan'];

    public function getAllDataKaryawan(Request $request)
    {
        $data = DB::table('karyawan')->join('users', 'users.id', 'karyawan.dealer_id')
        ->orderby('karyawan.nama','asc')->where('karyawan.flag','1');

            if($request->get('search')!=null){
                
                $data = $data->Where(function ($query) use ($request) {
                    $query
                    ->where('karyawan.nama','like',"%".$request->get('search')."%");
               });
            }
        
            return $data = $data->paginate(20);

    }

    public function getAllDealer()
    {
        $data = DB::table('users')
        ->orderby('users.name','asc')
        ->where('users.role','0')
        ->where('users.flag','1')
        ->get();

        return $data;
    }
}