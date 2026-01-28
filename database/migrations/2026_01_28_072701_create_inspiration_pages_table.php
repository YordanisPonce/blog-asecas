<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspiration_pages', function (Blueprint $table) {
            $table->id();

            // Título principal de la página
            $table->string('title_es')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            // (Opcional) texto debajo del título
            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();

            // (Opcional) SEO
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_description_es')->nullable();
            $table->string('seo_description_en')->nullable();
            $table->string('seo_description_fr')->nullable();

            // (Opcional) límite recomendado para grids (home/otros)
            $table->unsignedInteger('default_limit')->default(0); // 0 = todas

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspiration_pages');
    }
};
