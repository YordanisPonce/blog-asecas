<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_slug_translations_to_blogs_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('slug_en')->nullable()->after('slug');
            $table->string('slug_fr')->nullable()->after('slug_en');
            // Añadir índices únicos (opcional, pero recomendado)
            $table->unique('slug_en');
            $table->unique('slug_fr');
        });
    }

    public function down()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn(['slug_en', 'slug_fr']);
        });
    }
};