<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 255);
            $table->string('nisn', 255);
            $table->string('nama_siswa', 255);
            $table->enum('jeniskelamin', ['Laki-laki', 'Perempuan']);
            $table->string('alamat', 255);
            $table->string('no_telp', 255)->nullable();
            $table->integer('users_id');
            $table->string('kode_kelas', 255);
            $table->string('kode_thn_ajaran', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa');
    }
}
