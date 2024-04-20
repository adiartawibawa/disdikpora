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
        Schema::create('permohonans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('layanan_id');
            $table->text('prasyarat')->nullable();
            $table->text('formulir')->nullable();
            $table->timestamps();
        });

        Schema::create('permohonan_status', function (Blueprint $table) {
            $table->id();
            $table->morphs('permohonan');
            $table->char('status')->default(0); //0:dikirim; 1:diproses; 2:dikembalikan; 3:berhasil; 4:gagal
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonans');
    }
};
