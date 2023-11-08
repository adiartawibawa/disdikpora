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
        Schema::create('ketentuans', function (Blueprint $table) {
            $table->id();
            $table->uuidMorphs('ketentuan');
            $table->string('name');
            $table->text('desc');
            $table->enum('category', ['formulir', 'prasyarat'])->nullable();
            $table->boolean('is_required')->default(false);
            $table->string('type')->index();
            $table->string('key')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketentuans');
    }
};
