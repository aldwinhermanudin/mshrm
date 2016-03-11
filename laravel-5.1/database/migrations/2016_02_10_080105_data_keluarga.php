<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DataKeluarga extends Migration
{

    public function up()
    {
        Schema::create('public.data_keluarga', function (Blueprint $table) {
            $table->string('nrp', 128)->unique();
            $table->string('nama_pasangan', 128);
			$table->smallInteger('jumlah_anak');
            $table->string('nama_ibu', 256);
            $table->string('nama_ayah', 256);
            $table->string('kontak_keluarga_1', 128);
            $table->string('kontak_keluarga_2', 128);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('public.data_keluarga');
    }
}
