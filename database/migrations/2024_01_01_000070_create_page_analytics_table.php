<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Lightweight daily page view counter — no personal data stored
        Schema::create('page_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug', 100);
            $table->date('date')->index();
            $table->unsignedInteger('views')->default(0);

            $table->unique(['page_slug', 'date']);
            $table->index(['page_slug', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_analytics');
    }
};
