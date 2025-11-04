<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            // ---- Fix typos: sencond_* -> second_* ----
            if (Schema::hasColumn('homes', 'sencond_title_es')) {
                $table->renameColumn('sencond_title_es', 'second_title_es');
                $table->renameColumn('sencond_title_en', 'second_title_en');
                $table->renameColumn('sencond_title_fr', 'second_title_fr');
                $table->renameColumn('sencond_description_es', 'second_description_es');
                $table->renameColumn('sencond_description_en', 'second_description_en');
                $table->renameColumn('sencond_description_fr', 'second_description_fr');
            }

            // ---- URLs de imágenes para 1er y 2do bloque ----
            $table->string('first_image_url')->nullable()->after('first_description_fr');
            $table->string('second_image_url')->nullable()->after('second_image_title_fr');

            // ---- CTA central (help) ----
            $table->string('cta_help_title_es')->nullable();
            $table->string('cta_help_title_en')->nullable();
            $table->string('cta_help_title_fr')->nullable();
            $table->text('cta_help_text_es')->nullable();
            $table->text('cta_help_text_en')->nullable();
            $table->text('cta_help_text_fr')->nullable();
            $table->string('cta_help_button_es')->nullable();
            $table->string('cta_help_button_en')->nullable();
            $table->string('cta_help_button_fr')->nullable();
            $table->string('cta_help_url')->nullable();
            $table->string('cta_help_image_url')->nullable();
            $table->string('cta_help_image_title')->nullable();
            $table->string('cta_help_image_alt')->nullable();

            // ---- Applications (3 items) ----
            // [{image_url, image_title, image_alt, title_es/en/fr, link_url}]
            $table->json('applications_items')->nullable();

            // ---- Finishes (tabs + items) ----
            // [{tab_title_es/en/fr, items:[{icon_url, icon_title, icon_alt, title_es/en/fr, link_url}]}]
            $table->json('finishes_tabs')->nullable();

            // ---- SEO opcional ----
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_description_es', 300)->nullable();
            $table->string('seo_description_en', 300)->nullable();
            $table->string('seo_description_fr', 300)->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            // Reversión simple (no renombro de vuelta para evitar pérdida)
            $table->dropColumn([
                'first_image_url','second_image_url',
                'cta_help_title_es','cta_help_title_en','cta_help_title_fr',
                'cta_help_text_es','cta_help_text_en','cta_help_text_fr',
                'cta_help_button_es','cta_help_button_en','cta_help_button_fr',
                'cta_help_url','cta_help_image_url','cta_help_image_title','cta_help_image_alt',
                'applications_items','finishes_tabs',
                'seo_title_es','seo_title_en','seo_title_fr',
                'seo_description_es','seo_description_en','seo_description_fr',
            ]);
        });
    }
};
