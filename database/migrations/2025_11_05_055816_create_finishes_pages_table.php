<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_finishes_pages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finishes_pages', function (Blueprint $table) {
            $table->id();

            // Título de la página
            $table->string('page_title_es')->nullable();
            $table->string('page_title_en')->nullable();
            $table->string('page_title_fr')->nullable();

            // Texto introductorio (opcional)
            $table->text('intro_es')->nullable();
            $table->text('intro_en')->nullable();
            $table->text('intro_fr')->nullable();

            /**
             * Lista de acabados:
             * [
             *   {
             *     "slug": "hammered-scraped",
             *     "image_url": "...",
             *     "image_title": "...",
             *     "image_alt": "...",
             *     "title_es": "...", "title_en": "...", "title_fr": "...",
             *     "description_es": "...", "description_en": "...", "description_fr": "...",
             *     "badges": [
             *        {"icon_url":"...","icon_title":"...","icon_alt":"...","label_es":"...","label_en":"...","label_fr":"..."}
             *     ]
             *   },
             *   ...
             * ]
             */
            $table->json('finishes_items')->nullable();

            // SEO
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_description_es', 300)->nullable();
            $table->string('seo_description_en', 300)->nullable();
            $table->string('seo_description_fr', 300)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finishes_pages');
    }
};
