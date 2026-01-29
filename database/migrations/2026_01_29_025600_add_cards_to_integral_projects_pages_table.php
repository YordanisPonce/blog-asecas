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
        Schema::table('integral_projects_pages', function (Blueprint $table) {
            $table->json('cards')->nullable()->after('hero_image_alt_fr');
        });
    }

    public function down(): void
    {
        Schema::table('integral_projects_pages', function (Blueprint $table) {
            $table->dropColumn('cards');
        });
    }
};
