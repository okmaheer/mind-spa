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
        Schema::table('tools', function (Blueprint $table) {
            $table->string('meta_title', 70)->nullable()->after('description');
            // make h1 and page_title nullable so old rows without them don't break
            $table->string('h1', 70)->nullable()->change();
            $table->string('page_title', 60)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tools', function (Blueprint $table) {
            $table->dropColumn('meta_title');
        });
    }
};
