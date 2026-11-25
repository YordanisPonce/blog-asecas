<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Texto ALT opcional de la imagen de portada, uno por idioma.
     * Columnas nulas: las noticias ya publicadas no cambian.
     */
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('photo_alt_es')->nullable();
            $table->string('photo_alt_en')->nullable();
            $table->string('photo_alt_fr')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['photo_alt_es', 'photo_alt_en', 'photo_alt_fr']);
        });
    }
};
