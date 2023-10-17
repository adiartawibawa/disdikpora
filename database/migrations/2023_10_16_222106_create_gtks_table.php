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
        Schema::create('gtks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('sekolah_id');
            $table->foreignUuid('user_id');
            $table->string('nama');
            $table->string('nik');
            $table->string('nuptk')->nullable();
            $table->string('nip')->nullable();
            $table->string('sex')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('status_tugas', ['induk', 'non induk'])->nullable();
            $table->char('status_kepegawaian'); // 0:Guru Honor Sekolah; 1:Honor Daerah TK.II Kab/Kota; 2:PNS; 3:PNS Depag; 4:PPPK; 5:Tenaga Honor Sekolah
            $table->boolean('is_kepsek')->default(false);
            $table->string('no_telp')->nullable();
            $table->timestamps();
        });

        Schema::create('gtk_info', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('gtk_id');
            $table->string('jenis');
            $table->longText('informasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gtk_info');
        Schema::dropIfExists('gtks');
    }
};
