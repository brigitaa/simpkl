<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKepalasekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepalasekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 255);
            $table->string('nama_kepsek', 255);
            $table->string('jabatan', 255);
            $table->string('pangkat_gol', 255);
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
        Schema::dropIfExists('kepalasekolah');
    }
}
