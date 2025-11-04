<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_privacy_pages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('privacy_pages', function (Blueprint $table) {
            $table->id();

            // Page title
            $table->string('page_title_es')->nullable();
            $table->string('page_title_en')->nullable();
            $table->string('page_title_fr')->nullable();

            // Bloques (según tu diseño)
            $table->text('intro_es')->nullable();
            $table->text('intro_en')->nullable();
            $table->text('intro_fr')->nullable();

            $table->text('controller_info_es')->nullable(); // Responsable del tratamiento
            $table->text('controller_info_en')->nullable();
            $table->text('controller_info_fr')->nullable();

            $table->text('purpose_es')->nullable();         // Para qué tratamos los datos
            $table->text('purpose_en')->nullable();
            $table->text('purpose_fr')->nullable();

            $table->text('legal_basis_es')->nullable();     // Base legal
            $table->text('legal_basis_en')->nullable();
            $table->text('legal_basis_fr')->nullable();

            $table->text('security_measures_es')->nullable(); // Medidas de seguridad
            $table->text('security_measures_en')->nullable();
            $table->text('security_measures_fr')->nullable();

            $table->text('data_sharing_es')->nullable();    // Con quién los comunicamos
            $table->text('data_sharing_en')->nullable();
            $table->text('data_sharing_fr')->nullable();

            $table->text('intl_transfers_es')->nullable();  // Transferencias internacionales
            $table->text('intl_transfers_en')->nullable();
            $table->text('intl_transfers_fr')->nullable();

            $table->text('retention_es')->nullable();       // Plazos de conservación
            $table->text('retention_en')->nullable();
            $table->text('retention_fr')->nullable();

            $table->text('rights_howto_es')->nullable();    // Cómo ejercer derechos
            $table->text('rights_howto_en')->nullable();
            $table->text('rights_howto_fr')->nullable();

            $table->text('modifications_es')->nullable();   // Modificaciones de la info
            $table->text('modifications_en')->nullable();
            $table->text('modifications_fr')->nullable();

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
        Schema::dropIfExists('privacy_pages');
    }
};
