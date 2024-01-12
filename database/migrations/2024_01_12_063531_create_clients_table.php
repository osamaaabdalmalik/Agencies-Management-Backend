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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('full_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('phone');
            $table->string('email');
            $table->string('password');
            $table->boolean('blocked')->default(0);
            $table->integer('verification_code')->nullable();
            $table->foreignId('nationality_id')->constrained('nationalities');
            $table->foreignId('cultural_level_id')->constrained('cultural_levels');
            $table->foreignId('governorate_id')->constrained('governorates');
            $table->foreignId('city_id')->constrained('cities');
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
