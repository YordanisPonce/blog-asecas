<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_cookies_pages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cookies_pages', function (Blueprint $table) {
            $table->id();

            // Título
            $table->string('page_title_es')->nullable();
            $table->string('page_title_en')->nullable();
            $table->string('page_title_fr')->nullable();

            // Bloques de contenido
            $table->text('intro_es')->nullable();
            $table->text('intro_en')->nullable();
            $table->text('intro_fr')->nullable();

            $table->text('collected_info_es')->nullable();     // qué se recoge / navegación
            $table->text('collected_info_en')->nullable();
            $table->text('collected_info_fr')->nullable();

            $table->text('personal_data_note_es')->nullable(); // no extraen info del disco / no datos personales salvo que el usuario los aporte
            $table->text('personal_data_note_en')->nullable();
            $table->text('personal_data_note_fr')->nullable();

            $table->text('consent_es')->nullable();            // consentimiento (GDPR)
            $table->text('consent_en')->nullable();
            $table->text('consent_fr')->nullable();

            $table->text('disable_reject_delete_es')->nullable(); // cómo deshabilitar/borrar por navegador
            $table->text('disable_reject_delete_en')->nullable();
            $table->text('disable_reject_delete_fr')->nullable();

            // Extras
            $table->date('last_updated_at')->nullable();
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();
            $table->string('seo_description_es', 300)->nullable();
            $table->string('seo_description_en', 300)->nullable();
            $table->string('seo_description_fr', 300)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cookies_pages');
    }
};
