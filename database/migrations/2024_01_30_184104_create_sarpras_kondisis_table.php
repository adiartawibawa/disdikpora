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
        Schema::create('sarpras_kondisis', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('kondisi');
            $table->char('kategori', 12);
            $table->string('slug');
            $table->decimal('prosentase')->default(0);
            $table->text('keterangan')->nullable();
            $table->date('tanggal_kondisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sarpras_kondisis');
    }
};
