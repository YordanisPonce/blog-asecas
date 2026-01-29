<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('work_with_us_pages', function (Blueprint $table) {
            $table->id();

            // HERO (imagen + título arriba)
            $table->string('hero_title_es')->nullable();
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_fr')->nullable();

            $table->string('hero_bg_image')->nullable(); // path en storage public o URL

            // CONTENIDO SECCIÓN IZQUIERDA (título + descripción)
            $table->string('section_title_es')->nullable();
            $table->string('section_title_en')->nullable();
            $table->string('section_title_fr')->nullable();

            $table->text('section_text_es')->nullable();
            $table->text('section_text_en')->nullable();
            $table->text('section_text_fr')->nullable();

            // FORM placeholders/labels (para no depender de i18n hardcode del front)
            $table->string('field_name_label_es')->nullable();
            $table->string('field_name_label_en')->nullable();
            $table->string('field_name_label_fr')->nullable();

            $table->string('field_phone_label_es')->nullable();
            $table->string('field_phone_label_en')->nullable();
            $table->string('field_phone_label_fr')->nullable();

            $table->string('field_email_label_es')->nullable();
            $table->string('field_email_label_en')->nullable();
            $table->string('field_email_label_fr')->nullable();

            $table->string('field_speciality_label_es')->nullable();
            $table->string('field_speciality_label_en')->nullable();
            $table->string('field_speciality_label_fr')->nullable();

            $table->string('field_message_label_es')->nullable();
            $table->string('field_message_label_en')->nullable();
            $table->string('field_message_label_fr')->nullable();

            $table->string('cv_label_es')->nullable();
            $table->string('cv_label_en')->nullable();
            $table->string('cv_label_fr')->nullable();

            $table->string('submit_text_es')->nullable();
            $table->string('submit_text_en')->nullable();
            $table->string('submit_text_fr')->nullable();

            // Legal + checkboxes
            $table->text('legal_info_text_es')->nullable(); // HTML o texto
            $table->text('legal_info_text_en')->nullable();
            $table->text('legal_info_text_fr')->nullable();

            $table->string('checkbox_1_label_es')->nullable();
            $table->string('checkbox_1_label_en')->nullable();
            $table->string('checkbox_1_label_fr')->nullable();

            $table->string('checkbox_2_label_es')->nullable();
            $table->string('checkbox_2_label_en')->nullable();
            $table->string('checkbox_2_label_fr')->nullable();

            // SEO (opcional)
            $table->string('seo_title_es')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->string('seo_title_fr')->nullable();

            $table->text('seo_description_es')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->text('seo_description_fr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('work_with_us_pages');
    }
};
