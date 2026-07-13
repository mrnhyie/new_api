<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tour_requests', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Tour Details
            $table->boolean('has_visited_before')->default(false);
            $table->date('tour_date');
            $table->foreignId('time_slot_id')->constrained('time_slots')->onDelete('set null');

            $table->foreignId('place_id')->nullable();
            $table->string('purpose');
            $table->integer('number_of_people_visiting')->nullable();


            // Personal Details
            $table->string('first_name');
            $table->string('other_names')->nullable();
            $table->string('email');
            $table->string('phone_number');
            $table->string('whatsapp_number')->nullable();
            $table->string('country');
            $table->string('city');
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('medical_conditions')->nullable();
            $table->string('how_did_you_hear_about_us');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tour_requests');
    }
};
