<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jabatan_id');
            $table->foreign('jabatan_id')->references('id')->on('jabatans');
            $table->foreignId('golongan_id');
            $table->foreign('golongan_id')->references('id')->on('golongans');
            $table->string('nip');
            $table->string('nama');
            $table->foreignId('jenis_kelamin_id');
            $table->foreign('jenis_kelamin_id')->references('id')->on('jenis_kelamins');
            $table->string('telepon');
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
        Schema::dropIfExists('pegawais');
    }
}
