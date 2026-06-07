<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penawarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lelang_id')->constrained('lelangs')->onDelete('cascade');
            $table->foreignId('pembeli_id')->constrained('users')->onDelete('cascade');
            $table->decimal('harga_tawar', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penawarans');
    }
};
