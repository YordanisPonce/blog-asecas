<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_spaces_pages_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spaces_pages', function (Blueprint $table) {
            $table->id();

            // Título de la página / bloque
            $table->string('title_es')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            // Descripción
            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();

            // Imagen principal (usamos URL para ser consistente con otras páginas)
            $table->string('image_url')->nullable();
            $table->string('image_title_es')->nullable();
            $table->string('image_title_en')->nullable();
            $table->string('image_title_fr')->nullable();
            $table->string('image_alt_es')->nullable();
            $table->string('image_alt_en')->nullable();
            $table->string('image_alt_fr')->nullable();

            // SEO (opcional)
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
        Schema::dropIfExists('spaces_pages');
    }
};
