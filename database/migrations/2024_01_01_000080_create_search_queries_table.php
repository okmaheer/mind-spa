<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tracks what users search for — used to prioritise future content
        Schema::create('search_queries', function (Blueprint $table) {
            $table->id();
            $table->string('query', 200)->index();
            $table->unsignedTinyInteger('results_count')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('search_queries');
    }
};
