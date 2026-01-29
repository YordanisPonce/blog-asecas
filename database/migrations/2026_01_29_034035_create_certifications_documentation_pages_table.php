<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('certifications_documentation_pages', function (Blueprint $table) {
            $table->id();

            // Título principal
            $table->string('title_es')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            /**
             * documents: JSON array
             * [
             *  {
             *    "key": "certificado-aenor",
             *    "title_es": "Certificado AENOR",
             *    "title_en": "...",
             *    "title_fr": "...",
             *    "file_path": "documents/certifications/aenor.pdf"
             *  }
             * ]
             */
            $table->json('documents')->nullable();

            // Soluciones (bloque inferior)
            $table->string('solutions_title_es')->nullable();
            $table->string('solutions_title_en')->nullable();
            $table->string('solutions_title_fr')->nullable();

            $table->text('solutions_description_es')->nullable();
            $table->text('solutions_description_en')->nullable();
            $table->text('solutions_description_fr')->nullable();

            // Categorías seleccionadas para mostrar en "Soluciones"
            $table->json('featured_categories')->nullable();

            // SEO
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
        Schema::dropIfExists('certifications_documentation_pages');
    }
};
