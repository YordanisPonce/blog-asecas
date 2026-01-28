<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {

            // 1) ✅ Te falta el título del primer bloque
            if (!Schema::hasColumn('homes', 'first_title_es')) {
                $table->string('first_title_es')->nullable()->after('id');
                $table->string('first_title_en')->nullable()->after('first_title_es');
                $table->string('first_title_fr')->nullable()->after('first_title_en');
            }

            // 2) ✅ CTA image alt/title por idioma (consistencia)
            if (!Schema::hasColumn('homes', 'cta_help_image_title_es')) {
                $table->string('cta_help_image_title_es')->nullable()->after('cta_help_image_url');
                $table->string('cta_help_image_title_en')->nullable()->after('cta_help_image_title_es');
                $table->string('cta_help_image_title_fr')->nullable()->after('cta_help_image_title_en');

                $table->string('cta_help_image_alt_es')->nullable()->after('cta_help_image_title_fr');
                $table->string('cta_help_image_alt_en')->nullable()->after('cta_help_image_alt_es');
                $table->string('cta_help_image_alt_fr')->nullable()->after('cta_help_image_alt_en');
            }
        });

        // 3) ✅ Limpieza: si ya NO usarás estas columnas en Home
        Schema::table('homes', function (Blueprint $table) {
            $drop = [];

            foreach (
                [
                    'applications_items',
                    'finishes_tabs',

                    'inspiration_text_es',
                    'inspiration_text_en',
                    'inspiration_text_fr',
                    'inspiration_images_es',
                    'inspiration_images_en',
                    'inspiration_images_fr',

                    'blog_text_es',
                    'blog_text_en',
                    'blog_text_fr',

                    // viejas no-localizadas del CTA (si vas a usar las nuevas)
                    'cta_help_image_title',
                    'cta_help_image_alt',
                ] as $col
            ) {
                if (Schema::hasColumn('homes', $col)) $drop[] = $col;
            }

            if (!empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            // revert básico (puedes dejarlo simple)
            foreach (
                [
                    'first_title_es',
                    'first_title_en',
                    'first_title_fr',
                    'cta_help_image_title_es',
                    'cta_help_image_title_en',
                    'cta_help_image_title_fr',
                    'cta_help_image_alt_es',
                    'cta_help_image_alt_en',
                    'cta_help_image_alt_fr',
                ] as $col
            ) {
                if (Schema::hasColumn('homes', $col)) $table->dropColumn($col);
            }

            // no recreo lo dropeado para evitar pérdida/confusión
        });
    }
};
