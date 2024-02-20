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
        Schema::create('jenis_ptks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->timestamps();
        });

        Schema::create('guru_tendik_kebutuhans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->organisation()->nullable();
            $table->foreignId('jenis_ptk_id')->constrained();
            $table->smallInteger('asn')->nullable();
            $table->smallInteger('non_asn')->nullable();
            $table->smallInteger('jml_sekarang')->nullable();
            $table->smallInteger('jml_kurang')->nullable();
            $table->boolean('active')->default(true);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_ptks');
        Schema::dropIfExists('guru_tendik_kebutuhans');
    }
};
