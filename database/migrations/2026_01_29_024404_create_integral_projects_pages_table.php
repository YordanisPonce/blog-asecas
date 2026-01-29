<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('integral_projects_pages', function (Blueprint $table) {
            $table->id();

            // ---------------- HERO ----------------
            $table->text('hero_title_es')->nullable();
            $table->text('hero_title_en')->nullable();
            $table->text('hero_title_fr')->nullable();

            $table->text('hero_description_es')->nullable();
            $table->text('hero_description_en')->nullable();
            $table->text('hero_description_fr')->nullable();

            $table->string('hero_image_url')->nullable();
            $table->string('hero_image_title_es')->nullable();
            $table->string('hero_image_title_en')->nullable();
            $table->string('hero_image_title_fr')->nullable();
            $table->string('hero_image_alt_es')->nullable();
            $table->string('hero_image_alt_en')->nullable();
            $table->string('hero_image_alt_fr')->nullable();

            // ---------------- 3 COLUMNAS ----------------
            // Col 1
            $table->string('col1_title_es')->nullable();
            $table->string('col1_title_en')->nullable();
            $table->string('col1_title_fr')->nullable();
            $table->text('col1_text_es')->nullable();
            $table->text('col1_text_en')->nullable();
            $table->text('col1_text_fr')->nullable();
            $table->text('col1_bullets_es')->nullable();
            $table->text('col1_bullets_en')->nullable();
            $table->text('col1_bullets_fr')->nullable();

            // Col 2
            $table->string('col2_title_es')->nullable();
            $table->string('col2_title_en')->nullable();
            $table->string('col2_title_fr')->nullable();
            $table->text('col2_text_es')->nullable();
            $table->text('col2_text_en')->nullable();
            $table->text('col2_text_fr')->nullable();
            $table->text('col2_bullets_es')->nullable();
            $table->text('col2_bullets_en')->nullable();
            $table->text('col2_bullets_fr')->nullable();

            // Col 3
            $table->string('col3_title_es')->nullable();
            $table->string('col3_title_en')->nullable();
            $table->string('col3_title_fr')->nullable();
            $table->text('col3_text_es')->nullable();
            $table->text('col3_text_en')->nullable();
            $table->text('col3_text_fr')->nullable();
            $table->text('col3_bullets_es')->nullable();
            $table->text('col3_bullets_en')->nullable();
            $table->text('col3_bullets_fr')->nullable();

            // ---------------- IMAGEN BANNER ----------------
            $table->string('banner_image_url')->nullable();
            $table->string('banner_image_title_es')->nullable();
            $table->string('banner_image_title_en')->nullable();
            $table->string('banner_image_title_fr')->nullable();
            $table->string('banner_image_alt_es')->nullable();
            $table->string('banner_image_alt_en')->nullable();
            $table->string('banner_image_alt_fr')->nullable();

            // ---------------- SEO ----------------
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->text('seo_description_es')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->text('seo_description_fr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('integral_projects_pages');
    }
};
