<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('foto_lelangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lelang_id')->constrained('lelangs')->onDelete('cascade');
            $table->string('path_foto');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foto_lelangs');
    }
};
