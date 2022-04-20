<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaprogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kaprog', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 255);
            $table->string('nama_kaprog', 255);
            $table->integer('users_id');
            $table->string('kode_keahlian', 255);
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
        Schema::dropIfExists('kaprog');
    }
}
