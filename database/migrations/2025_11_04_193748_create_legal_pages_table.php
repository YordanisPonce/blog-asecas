<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_legal_pages_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('legal_pages', function (Blueprint $table) {
            $table->id();

            // Page titles
            $table->string('page_title_es')->nullable();
            $table->string('page_title_en')->nullable();
            $table->string('page_title_fr')->nullable();

            // Identifying Information
            $table->text('ident_info_es')->nullable();
            $table->text('ident_info_en')->nullable();
            $table->text('ident_info_fr')->nullable();

            // Intellectual Property Rights
            $table->text('ip_rights_es')->nullable();
            $table->text('ip_rights_en')->nullable();
            $table->text('ip_rights_fr')->nullable();

            // General Terms of Use
            $table->text('terms_use_es')->nullable();
            $table->text('terms_use_en')->nullable();
            $table->text('terms_use_fr')->nullable();

            // Exclusion of Warranties and Liability
            $table->text('warranty_exclusion_es')->nullable();
            $table->text('warranty_exclusion_en')->nullable();
            $table->text('warranty_exclusion_fr')->nullable();

            // Security Measures
            $table->text('security_measures_es')->nullable();
            $table->text('security_measures_en')->nullable();
            $table->text('security_measures_fr')->nullable();

            // Modifications
            $table->text('modifications_es')->nullable();
            $table->text('modifications_en')->nullable();
            $table->text('modifications_fr')->nullable();

            // Applicable Law and Jurisdiction
            $table->text('applicable_law_es')->nullable();
            $table->text('applicable_law_en')->nullable();
            $table->text('applicable_law_fr')->nullable();

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
        Schema::dropIfExists('legal_pages');
    }
};
