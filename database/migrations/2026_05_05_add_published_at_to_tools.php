<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable()->after('is_active');
            $table->index(['published_at', 'is_active'], 'tools_published_at_is_active_index');
        });

        DB::table('tools')->update(['published_at' => now()]);
    }

    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropIndex('tools_published_at_is_active_index');
            $table->dropColumn('published_at');
        });
    }
};
