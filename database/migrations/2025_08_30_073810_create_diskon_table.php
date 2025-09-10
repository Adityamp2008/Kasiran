<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('diskon', function (Blueprint $table) {
            $table->id();
            $table->string('nama_diskon');
            $table->enum('tipe', ['potongan', 'persen']);
            $table->integer('nilai'); // angka potongan atau persen
            $table->integer('min_belanja')->nullable(); // minimal total belanja
            $table->integer('min_qty')->nullable(); // minimal jumlah barang
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon');
    }
};
