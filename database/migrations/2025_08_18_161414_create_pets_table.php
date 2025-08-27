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
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            
            // foreign key to owners.id
            $table->foreignId('owner_id')
                  ->constrained()             // assumes 'owners' table
                  ->onDelete('cascade');
            
            $table->string('name');
            $table->string('species');
            $table->string('breed')->nullable();
            $table->date('birthdate')->nullable();
            $table->enum('sex', ['male','female'])->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pets');
    }

};
