<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('lelangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('penjual_id')->constrained('users')->onDelete('cascade');
            $table->string('judul', 100);
            $table->text('deskripsi');
            $table->decimal('harga_awal', 15, 2);
            $table->dateTime('waktu_mulai');
            $table->dateTime('waktu_berakhir');
            $table->string('titik_pertemuan'); // alamat atau koordinat
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('lelangs');
    }
};
