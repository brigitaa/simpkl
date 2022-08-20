<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->string('id', 32)->primarykey();
            $table->integer('siswa_id');
            $table->integer('periode_id');
            $table->integer('dudi_id');
            $table->string('pernyataan_ortu', 255);
            $table->string('pernyataan_siswa', 255);
            $table->enum('status_verif_pokja', ['Diproses', 'Disetujui', 'Ditolak'])->default('Diproses');
            $table->enum('status_verif_kaprog', ['Diproses', 'Disetujui', 'Ditolak'])->default('Diproses');
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
        Schema::dropIfExists('pengajuan');
    }
}
