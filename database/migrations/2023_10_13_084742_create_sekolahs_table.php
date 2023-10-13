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
        Schema::create('sekolahs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('npsn', 8);
            $table->string('nama');
            $table->enum('status', ['negeri', 'swasta'])->nullable();
            $table->text('alamat');
            $table->char('village_code', 10);
            $table->point('lokasi');
            $table->timestamps();

            $table->foreign('village_code')
                ->references('code')
                ->on('indonesia_villages')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolahs');
    }
};
