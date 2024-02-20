<?php

use App\Models\Organisation;
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
        $organisation = Organisation::first() ?? Organisation::create([
            'name' => 'Default Organisation',
        ]);

        Schema::table('users', function (Blueprint $table) use ($organisation) {
            $table->organisation()->after('id')->default($organisation->id);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropOrganisation();
        });
    }
};
