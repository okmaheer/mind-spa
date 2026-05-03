<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_attempts', function (Blueprint $table) {
            $table->id();
            $table->string('session_id', 100)->index();
            $table->string('category', 50)->index();
            $table->unsignedTinyInteger('score');
            $table->unsignedTinyInteger('total_questions');
            $table->unsignedSmallInteger('time_taken_seconds')->nullable();
            $table->timestamp('completed_at')->useCurrent()->index();

            $table->index(['category', 'completed_at']);
            $table->index(['session_id', 'category']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_attempts');
    }
};
