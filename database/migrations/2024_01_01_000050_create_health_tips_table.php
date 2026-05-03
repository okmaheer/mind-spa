<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_tips', function (Blueprint $table) {
            $table->id();
            $table->text('tip');
            $table->string('category', 50)->index();
            $table->unsignedSmallInteger('day_number')->unique(); // 1–365
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_tips');
    }
};
