<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('alamat')->nullable();
            $table->string('kode')->nullable();
            $table->string('group')->nullable();
            $table->string('no_telp')->nullable();
            $table->integer('role')->default(1); 
            $table->integer('flag')->default(1);
            $table->timestamps();
            $table->rememberToken();
        });

        DB::table('users')->insert([
	        'name' => 'Admin Website',
	        'email' => 'admin@admin.com',
            'password' => '$2y$10$MxF7u36tvlOxAFpqtdXDW.POE76rDrUmtEzgrUXwLpYPMHZdjUuve',
            'alamat' => 'Jln. Wahid Hasyim, Ngropoh Gang Pucung 2 Nomor 61, Condongcatur, Depok',
            'no_telp' => '082136030504',
            'role' => '1',
            'flag' => '1',
            'created_at' => \Carbon\Carbon::now('Asia/Jakarta')->toDateTimeString(),
	        'remember_token' => '0vzFEJs1n8STJAcxMxOGFG0QRu8W6ngm6rzre1b57cbZYCT2Hkfm5k7sxFor'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
