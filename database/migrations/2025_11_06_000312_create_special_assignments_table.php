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
        Schema::create('special_assignments', function (Blueprint $table) {
            $table->id();
            $table->integer('max_6')->nullable();
            $table->integer('max_7')->nullable();
            $table->integer('max_8')->nullable();
            $table->string('who_can_assign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_assignments');
    }
};
