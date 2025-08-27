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
        Schema::table('appointment_reactions', function (Blueprint $table) {
            $table->foreignId('appointment_id')
                ->after('id')
                ->constrained()        // references appointments.id
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::table('appointment_reactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('appointment_id');
        });
    }
};
