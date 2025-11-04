<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_empresas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();

            // HERO (video o imagen de fondo + titular)
            $table->string('hero_title_es')->nullable();
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_fr')->nullable();
            $table->string('hero_video_url')->nullable(); // si usas video
            $table->string('hero_image')->nullable();     // fallback imagen

            // ABOUT (somos Grupo Estucalia)
            $table->string('about_title_es')->nullable();
            $table->string('about_title_en')->nullable();
            $table->string('about_title_fr')->nullable();
            $table->text('about_text_es')->nullable();
            $table->text('about_text_en')->nullable();
            $table->text('about_text_fr')->nullable();
            $table->string('about_illustration')->nullable();

            // MISIÓN
            $table->string('mission_title_es')->nullable();
            $table->string('mission_title_en')->nullable();
            $table->string('mission_title_fr')->nullable();
            $table->text('mission_text_es')->nullable();
            $table->text('mission_text_en')->nullable();
            $table->text('mission_text_fr')->nullable();

            // PRODUCCIÓN / CAPACIDAD (100,000 tons/year) + media
            $table->string('production_title_es')->nullable();
            $table->string('production_title_en')->nullable();
            $table->string('production_title_fr')->nullable();
            $table->text('production_text_es')->nullable();
            $table->text('production_text_en')->nullable();
            $table->text('production_text_fr')->nullable();
            $table->string('production_stat')->nullable();   // "100,000 tons/year"
            $table->string('production_media_url')->nullable(); // video o imagen

            // SOLUCIONES DE CONSTRUCCIÓN (lista con iconos)
            $table->string('solutions_title_es')->nullable();
            $table->string('solutions_title_en')->nullable();
            $table->string('solutions_title_fr')->nullable();
            $table->text('solutions_intro_es')->nullable();
            $table->text('solutions_intro_en')->nullable();
            $table->text('solutions_intro_fr')->nullable();
            $table->json('solutions_items_es')->nullable(); // [{icon,title,subtitle}]
            $table->json('solutions_items_en')->nullable();
            $table->json('solutions_items_fr')->nullable();

            // INTERNACIONAL (texto + imagen de ciudad)
            $table->string('international_title_es')->nullable();
            $table->string('international_title_en')->nullable();
            $table->string('international_title_fr')->nullable();
            $table->text('international_text_es')->nullable();
            $table->text('international_text_en')->nullable();
            $table->text('international_text_fr')->nullable();
            $table->string('international_image')->nullable();

            // CERTIFICACIONES (texto + logos)
            $table->string('certs_title_es')->nullable();
            $table->string('certs_title_en')->nullable();
            $table->string('certs_title_fr')->nullable();
            $table->text('certs_text_es')->nullable();
            $table->text('certs_text_en')->nullable();
            $table->text('certs_text_fr')->nullable();
            $table->json('certs_logos')->nullable(); // [{logo_url,alt}]

            // CONSULTORÍA PERSONALIZADA (bg, texto, CTA)
            $table->string('consulting_title_es')->nullable();
            $table->string('consulting_title_en')->nullable();
            $table->string('consulting_title_fr')->nullable();
            $table->text('consulting_text_es')->nullable();
            $table->text('consulting_text_en')->nullable();
            $table->text('consulting_text_fr')->nullable();
            $table->string('consulting_cta_text_es')->nullable();
            $table->string('consulting_cta_text_en')->nullable();
            $table->string('consulting_cta_text_fr')->nullable();
            $table->string('consulting_cta_url')->nullable();
            $table->string('consulting_bg_image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
