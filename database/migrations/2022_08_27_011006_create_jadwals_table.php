<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('maskapai_id');
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->integer('harga_tiket');
            $table->datetime('jadwal_keberangkatan');
            $table->datetime('jadwal_pulang');
            $table->string('nomor_penerbangan');
            $table->string('kelas_penerbangan');
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
        Schema::dropIfExists('jadwal_penerbangans');
    }
};
