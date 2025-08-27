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
    public function up()
    {
        Schema::table('veterinarians', function (Blueprint $table) {
            // Place vet_name right after the ID or adjust as needed
            $table->string('vet_name')
                ->nullable()
                ->after('id');
        });
    }

    public function down()
    {
        Schema::table('veterinarians', function (Blueprint $table) {
            $table->dropColumn('vet_name');
        });
    }
};
