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
        Schema::create('batch_children', function (Blueprint $table) {
            $table->id();
            $table->double('total');
            $table->foreignId('batch_id')->constrained('batches');
            $table->foreignId('child_id')->constrained('agents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_children');
    }
};
