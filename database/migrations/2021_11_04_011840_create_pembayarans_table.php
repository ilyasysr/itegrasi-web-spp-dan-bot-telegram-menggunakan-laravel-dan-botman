<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id');
            $table->foreignId('spp_id');
            $table->foreignId('user_id')->nullable();
            $table->string('bulan', 15)->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->string('no_bayar', 20)->nullable();
            $table->integer('biaya');
            $table->date('tgl_bayar')->nullable();
            $table->string('keterangan', 20)->nullable();
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
        Schema::dropIfExists('pembayarans');
    }
}
