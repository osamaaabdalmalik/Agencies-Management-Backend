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
        Schema::create('agents', function (Blueprint $table) {
            $table->id()->startingValue(1000);
            $table->string('password');
            $table->string('receipt_number');
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('receptionist_id')->nullable()->constrained('receptionists');
            $table->foreignId('parent_id')->nullable()->constrained('agents');
            $table->foreignId('left_id')->nullable()->constrained('agents');
            $table->foreignId('right_id')->nullable()->constrained('agents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
