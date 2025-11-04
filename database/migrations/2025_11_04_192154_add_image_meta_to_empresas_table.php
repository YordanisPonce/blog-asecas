<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_image_meta_to_empresas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            // HERO
            $table->string('hero_image_title')->nullable()->after('hero_image');
            $table->string('hero_image_alt')->nullable()->after('hero_image_title');

            // ABOUT
            $table->string('about_illustration_title')->nullable()->after('about_illustration');
            $table->string('about_illustration_alt')->nullable()->after('about_illustration_title');

            // PRODUCCIÓN (agregamos imagen opcional + meta)
            $table->string('production_image')->nullable()->after('production_media_url');
            $table->string('production_image_title')->nullable()->after('production_image');
            $table->string('production_image_alt')->nullable()->after('production_image_title');

            // INTERNACIONAL
            $table->string('international_image_title')->nullable()->after('international_image');
            $table->string('international_image_alt')->nullable()->after('international_image_title');

            // CONSULTORÍA (bg)
            $table->string('consulting_bg_image_title')->nullable()->after('consulting_bg_image');
            $table->string('consulting_bg_image_alt')->nullable()->after('consulting_bg_image_title');
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
            ]);
        });
    }
};
