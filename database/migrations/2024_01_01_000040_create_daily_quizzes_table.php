<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('daily_quizzes', function (Blueprint $table) {
            $table->id();
            $table->date('date')->unique();
            $table->string('topic', 100);
            $table->string('difficulty', 10)->default('medium');
            $table->json('question_ids');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['date', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('daily_quizzes');
    }
};
