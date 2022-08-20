<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenempatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penempatan', function (Blueprint $table) {
            $table->id();
            $table->integer('konfirmasi_dudi_id');
            $table->integer('guru_monitoring_id')->nullable();
            $table->enum('status_pkl', ['Belum terlaksana', 'Sedang berlangsung', 'Sudah terlaksana']);
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
        Schema::dropIfExists('penempatan');
    }
}
