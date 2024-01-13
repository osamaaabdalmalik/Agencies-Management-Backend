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
            $table->string('user_name')->nullable();
            $table->string('full_name');
            $table->string('mother_name');
            $table->string('gender');
            $table->date('birth_date');
            $table->string('phone',10);
            $table->string('email');
            $table->string('password')->nullable();
            $table->boolean('blocked')->default(0);
            $table->integer('verification_code')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('nationality_id')->constrained('nationalities');
            $table->foreignId('cultural_level_id')->constrained('cultural_levels');
            $table->foreignId('governorate_id')->constrained('governorates');
            $table->foreignId('city_id')->constrained('cities');
            $table->foreignId('receptionist_id')->nullable()->constrained('receptionists');
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
