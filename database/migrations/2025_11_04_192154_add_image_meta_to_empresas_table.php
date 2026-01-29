<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {

            // HERO meta
            $table->string('hero_image_title')->nullable();
            $table->string('hero_image_alt')->nullable();

            // ABOUT meta
            $table->string('about_illustration_title')->nullable();
            $table->string('about_illustration_alt')->nullable();

            // PRODUCCIÓN extra (imagen opcional + meta)
            $table->string('production_image')->nullable();
            $table->string('production_image_title')->nullable();
            $table->string('production_image_alt')->nullable();

            // INTERNACIONAL meta
            $table->string('international_image_title')->nullable();
            $table->string('international_image_alt')->nullable();

            // CONSULTORÍA meta
            $table->string('consulting_bg_image_title')->nullable();
            $table->string('consulting_bg_image_alt')->nullable();

            // ✅ SEGUNDO VIDEO
            $table->string('solutions_video_url')->nullable();

            // ✅ CATEGORÍAS DESTACADAS (ordenables)
            $table->json('featured_categories_items')->nullable();

            // ✅ BG FINAL
            $table->string('bottom_bg_image')->nullable();
            $table->string('bottom_bg_image_title')->nullable();
            $table->string('bottom_bg_image_alt')->nullable();

            // ✅ (Opcional pero recomendado por tu screenshot) CTA en Certificaciones
            $table->string('certs_cta_text_es')->nullable();
            $table->string('certs_cta_text_en')->nullable();
            $table->string('certs_cta_text_fr')->nullable();
            $table->string('certs_cta_url')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn([
                'hero_image_title',
                'hero_image_alt',
                'about_illustration_title',
                'about_illustration_alt',
                'production_image',
                'production_image_title',
                'production_image_alt',
                'international_image_title',
                'international_image_alt',
                'consulting_bg_image_title',
                'consulting_bg_image_alt',
                'solutions_video_url',
                'featured_categories_items',
                'bottom_bg_image',
                'bottom_bg_image_title',
                'bottom_bg_image_alt',
                'certs_cta_text_es',
                'certs_cta_text_en',
                'certs_cta_text_fr',
                'certs_cta_url',
            ]);
        });
    }
};
