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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // foreign key to pets.id
            $table->foreignId('pet_id')
                  ->constrained()             // assumes 'pets' table
                  ->onDelete('cascade');
            
            // foreign key to veterinarians.id
            $table->foreignId('vet_id')
                  ->constrained('veterinarians')
                  ->onDelete('cascade');
            
            $table->dateTime('scheduled_at');
            $table->enum('status', ['pending','confirmed','canceled'])
                  ->default('pending');
            $table->text('notes')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('appointments');
    }

};
