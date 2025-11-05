<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Nombre por idioma
            $table->string('name_es')->nullable()->after('name');
            $table->string('name_en')->nullable()->after('name_es');
            $table->string('name_fr')->nullable()->after('name_en');

            // Alt/title por idioma
            $table->string('image_alt_es')->nullable()->after('image_alt');
            $table->string('image_alt_en')->nullable()->after('image_alt_es');
            $table->string('image_alt_fr')->nullable()->after('image_alt_en');

            $table->string('image_title_es')->nullable()->after('image_title');
            $table->string('image_title_en')->nullable()->after('image_title_es');
            $table->string('image_title_fr')->nullable()->after('image_title_en');

            // Enlace opcional desde la tarjeta
            $table->string('link_url')->nullable()->after('photo');

            // Orden opcional para la home
            $table->unsignedInteger('position')->nullable()->after('link_url');
            $table->boolean('is_active')->default(true)->after('position');
        });
    }

    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'name_es',
                'name_en',
                'name_fr',
                'image_alt_es',
                'image_alt_en',
                'image_alt_fr',
                'image_title_es',
                'image_title_en',
                'image_title_fr',
                'link_url',
                'position',
                'is_active',
            ]);
        });
    }
};
