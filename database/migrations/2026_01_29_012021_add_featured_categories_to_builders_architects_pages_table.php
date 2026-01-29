<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('builders_architects_pages', function (Blueprint $table) {
            $table->json('featured_categories')->nullable()->after('featured_products');
        });
    }

    public function down(): void
    {
        Schema::table('builders_architects_pages', function (Blueprint $table) {
            $table->dropColumn('featured_categories');
        });
    }
};
