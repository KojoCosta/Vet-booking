<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn(['name', 'email']);
        });
    }

    public function down(): void
    {
        Schema::table('owners', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
        });
    }
};
