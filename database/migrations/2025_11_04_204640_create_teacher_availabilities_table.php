<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teacher_availabilities', function (Blueprint $table) {
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->primary();
            $table->boolean('M6')->default(false);
            $table->boolean('T6')->default(false);
            $table->boolean('W6')->default(false);
            $table->boolean('R6')->default(false);
            $table->boolean('F6')->default(false);
            $table->boolean('M7')->default(false);
            $table->boolean('T7')->default(false);
            $table->boolean('W7')->default(false);
            $table->boolean('R7')->default(false);
            $table->boolean('F7')->default(false);
            $table->boolean('M8')->default(false);
            $table->boolean('T8')->default(false);
            $table->boolean('W8')->default(false);
            $table->boolean('R8')->default(false);
            $table->boolean('F8')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teacher_availabilities');
    }
};
