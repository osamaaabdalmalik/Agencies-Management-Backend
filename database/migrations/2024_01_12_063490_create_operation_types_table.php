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
        Schema::create('admin_registers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('thing_id');
            $table->foreignId('admin_id')->constrained('admins');
            $table->foreignId('operation_type_id')->constrained('operation_types');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_registers');
    }
};
