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
        Schema::create('places', function (Blueprint $table) {
            //  Defaults
            $table->id();
            $table->timestamps();

            //  Place Details
            $table->string('category');
            $table->string('location');
            $table->string('center_number')->nullable(); // nullable for now until we have center numbers

        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};

