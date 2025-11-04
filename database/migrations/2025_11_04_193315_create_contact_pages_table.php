<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_contact_pages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_pages', function (Blueprint $table) {
            $table->id();

            // MAPA
            $table->string('map_embed_url')->nullable();

            // TÍTULO Y DIRECCIÓN
            $table->string('contact_title_es')->nullable();
            $table->string('contact_title_en')->nullable();
            $table->string('contact_title_fr')->nullable();

            $table->string('address_line')->nullable(); // "Camino Viejo de Fortuna, 40"
            $table->string('city')->nullable();         // "30140 Matasana, Santomera"
            $table->string('region')->nullable();       // "Murcia"
            $table->string('country')->nullable();      // "Spain"

            // TELÉFONOS Y EMAILS (arrays)
            $table->json('phones')->nullable();         // [{label, number}]
            $table->json('emails')->nullable();         // [{label, email}]

            // HORARIO (texto por idioma)
            $table->text('schedule_text_es')->nullable();
            $table->text('schedule_text_en')->nullable();
            $table->text('schedule_text_fr')->nullable();

            // AVISO LEGAL / PRIVACIDAD (párrafo bajo el formulario)
            $table->text('legal_info_text_es')->nullable();
            $table->text('legal_info_text_en')->nullable();
            $table->text('legal_info_text_fr')->nullable();

            // Etiquetas de checkboxes
            $table->string('checkbox_1_label_es')->nullable();
            $table->string('checkbox_1_label_en')->nullable();
            $table->string('checkbox_1_label_fr')->nullable();
            $table->string('checkbox_2_label_es')->nullable();
            $table->string('checkbox_2_label_en')->nullable();
            $table->string('checkbox_2_label_fr')->nullable();

            // CTA (bloque con imagen de fondo)
            $table->string('cta_title_es')->nullable();
            $table->string('cta_title_en')->nullable();
            $table->string('cta_title_fr')->nullable();

            $table->text('cta_text_es')->nullable();
            $table->text('cta_text_en')->nullable();
            $table->text('cta_text_fr')->nullable();

            $table->string('cta_button_text_es')->nullable();
            $table->string('cta_button_text_en')->nullable();
            $table->string('cta_button_text_fr')->nullable();
            $table->string('cta_button_url')->nullable();

            $table->string('cta_bg_image')->nullable();
            $table->string('cta_bg_image_title')->nullable();
            $table->string('cta_bg_image_alt')->nullable();

            // Redes
            $table->string('social_linkedin')->nullable();
            $table->string('social_facebook')->nullable();
            $table->string('social_instagram')->nullable();
            $table->string('social_youtube')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_pages');
    }
};
