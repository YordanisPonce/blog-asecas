<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('applicators_pages', function (Blueprint $table) {
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
            $table->string('col1_title_es')->nullable();
            $table->string('col1_title_en')->nullable();
            $table->string('col1_title_fr')->nullable();
            $table->text('col1_text_es')->nullable();
            $table->text('col1_text_en')->nullable();
            $table->text('col1_text_fr')->nullable();
            $table->text('col1_bullets_es')->nullable();
            $table->text('col1_bullets_en')->nullable();
            $table->text('col1_bullets_fr')->nullable();

            $table->string('col2_title_es')->nullable();
            $table->string('col2_title_en')->nullable();
            $table->string('col2_title_fr')->nullable();
            $table->text('col2_text_es')->nullable();
            $table->text('col2_text_en')->nullable();
            $table->text('col2_text_fr')->nullable();
            $table->text('col2_bullets_es')->nullable();
            $table->text('col2_bullets_en')->nullable();
            $table->text('col2_bullets_fr')->nullable();

            $table->string('col3_title_es')->nullable();
            $table->string('col3_title_en')->nullable();
            $table->string('col3_title_fr')->nullable();
            $table->text('col3_text_es')->nullable();
            $table->text('col3_text_en')->nullable();
            $table->text('col3_text_fr')->nullable();
            $table->text('col3_bullets_es')->nullable();
            $table->text('col3_bullets_en')->nullable();
            $table->text('col3_bullets_fr')->nullable();

            // ---------------- BANNER ----------------
            $table->string('banner_image_url')->nullable();
            $table->string('banner_image_title_es')->nullable();
            $table->string('banner_image_title_en')->nullable();
            $table->string('banner_image_title_fr')->nullable();
            $table->string('banner_image_alt_es')->nullable();
            $table->string('banner_image_alt_en')->nullable();
            $table->string('banner_image_alt_fr')->nullable();

            // ---------------- BLOQUE FINAL (texto + beneficios + textos legales) ----------------
            $table->string('final_title_es')->nullable();
            $table->string('final_title_en')->nullable();
            $table->string('final_title_fr')->nullable();

            $table->text('final_description_es')->nullable();
            $table->text('final_description_en')->nullable();
            $table->text('final_description_fr')->nullable();

            // Beneficios: array de items con traducciones
            // [
            //   { title_es, text_es, title_en, text_en, title_fr, text_fr },
            //   ...
            // ]
            $table->json('benefits')->nullable();

            // Textos legales/checkbox del form (configurables)
            $table->text('form_privacy_es')->nullable();
            $table->text('form_privacy_en')->nullable();
            $table->text('form_privacy_fr')->nullable();

            $table->text('form_checkbox1_es')->nullable();
            $table->text('form_checkbox1_en')->nullable();
            $table->text('form_checkbox1_fr')->nullable();

            $table->text('form_checkbox2_es')->nullable();
            $table->text('form_checkbox2_en')->nullable();
            $table->text('form_checkbox2_fr')->nullable();

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
        Schema::dropIfExists('applicators_pages');
    }
};
