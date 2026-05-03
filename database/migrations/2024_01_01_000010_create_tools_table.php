<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category', 30)->index();  // sleep|fitness|nutrition|quiz|kids|life|games
            $table->string('type', 20)->default('calculator'); // calculator|quiz|game|seo
            $table->string('icon', 10)->nullable();
            $table->string('description', 300);
            $table->string('meta_description', 155);
            $table->string('h1', 70);
            $table->string('page_title', 60);
            $table->json('keywords')->nullable();
            $table->unsignedInteger('monthly_searches')->default(0)->index();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->boolean('show_in_nav')->default(true);
            $table->timestamps();

            $table->index(['category', 'is_active', 'sort_order']);
            $table->index(['monthly_searches', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
