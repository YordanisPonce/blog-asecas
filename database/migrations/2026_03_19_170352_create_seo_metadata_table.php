<?php
// database/migrations/2024_xx_xx_xxxxxx_create_seo_metadata_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('seo_metadata', function (Blueprint $table) {
            $table->id();

            // Relación polimórfica (se conecta a cualquier modelo)
            $table->string('seoable_type');  // Ej: App\Models\Empresa
            $table->unsignedBigInteger('seoable_id');
            $table->index(['seoable_type', 'seoable_id']);

            // ===== CAMPOS QUE PIDIÓ EL CLIENTE =====
            // Title (multidioma)
            $table->string('meta_title_es')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_fr')->nullable();

            // Description (multidioma)
            $table->text('meta_description_es')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_fr')->nullable();

            // Keywords (multidioma)
            $table->text('meta_keywords_es')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->text('meta_keywords_fr')->nullable();

            // Robots
            $table->string('meta_robots')->default('index, follow');

            // Author y Publisher
            $table->string('meta_author')->nullable();
            $table->string('meta_publisher')->nullable();

            // Language (se manejará por URL/parámetro)
            // Generator (lo pondremos fijo en el frontend)

            // URL Canónica
            $table->string('canonical_url')->nullable();

            // ===== CAMPOS ADICIONALES RECOMENDADOS =====
            // Open Graph (Facebook, LinkedIn, WhatsApp)
            $table->string('og_title_es')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_title_fr')->nullable();

            $table->text('og_description_es')->nullable();
            $table->text('og_description_en')->nullable();
            $table->text('og_description_fr')->nullable();

            $table->string('og_image')->nullable();
            $table->string('og_type')->default('website');

            // Twitter Cards
            $table->string('twitter_card')->default('summary_large_image');
            $table->string('twitter_title_es')->nullable();
            $table->string('twitter_title_en')->nullable();
            $table->string('twitter_title_fr')->nullable();

            $table->text('twitter_description_es')->nullable();
            $table->text('twitter_description_en')->nullable();
            $table->text('twitter_description_fr')->nullable();

            $table->string('twitter_image')->nullable();

            $table->timestamps();

            // Garantizar que cada modelo tenga UN SOLO registro SEO
            $table->unique(['seoable_type', 'seoable_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_metadata');
    }
};
