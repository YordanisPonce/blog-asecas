<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('slug_fr')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('slug_fr')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->string('name_en');
            $table->string('name_fr');
            $table->string('slug_fr')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['slug_fr']);
            $table->dropForeign(['slug_en']);
            $table->dropColumn([
                'name_en',
                'name_fr',
                'slug_fr',
                'slug_en',
            ]);
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['slug_fr']);
            $table->dropForeign(['slug_en']);
            $table->dropColumn([
                'name_en',
                'name_fr',
                'slug_fr',
                'slug_en',
            ]);
        });
        Schema::table('applications', function (Blueprint $table) {
            $table->dropForeign(['slug_fr']);
            $table->dropForeign(['slug_en']);
            $table->dropColumn([
                'name_en',
                'name_fr',
                'slug_fr',
                'slug_en',
            ]);
        });
    }
};
