<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('footer_pages', function (Blueprint $table) {
            $table->id();

            // Logo (path en public disk o URL)
            $table->string('logo')->nullable();

            // Titles (multi-idioma)
            $table->string('legal_title_es')->nullable();
            $table->string('legal_title_en')->nullable();
            $table->string('legal_title_fr')->nullable();

            $table->string('company_title_es')->nullable();
            $table->string('company_title_en')->nullable();
            $table->string('company_title_fr')->nullable();

            $table->string('products_title_es')->nullable();
            $table->string('products_title_en')->nullable();
            $table->string('products_title_fr')->nullable();

            $table->string('contact_title_es')->nullable();
            $table->string('contact_title_en')->nullable();
            $table->string('contact_title_fr')->nullable();

            $table->string('follow_title_es')->nullable();
            $table->string('follow_title_en')->nullable();
            $table->string('follow_title_fr')->nullable();

            // Links (JSON por idioma): [{ label_html, url }]
            $table->json('legal_links_es')->nullable();
            $table->json('legal_links_en')->nullable();
            $table->json('legal_links_fr')->nullable();

            $table->json('company_links_es')->nullable();
            $table->json('company_links_en')->nullable();
            $table->json('company_links_fr')->nullable();

            $table->json('products_links_es')->nullable();
            $table->json('products_links_en')->nullable();
            $table->json('products_links_fr')->nullable();

            // Contact (address puede ser HTML por idioma)
            $table->text('contact_address_html_es')->nullable();
            $table->text('contact_address_html_en')->nullable();
            $table->text('contact_address_html_fr')->nullable();

            // Contact shared (no necesita idioma)
            $table->string('contact_phone_1')->nullable();
            $table->string('contact_phone_2')->nullable();
            $table->string('contact_email')->nullable();

            // Social links (JSON por idioma) [{ label_html, url, icon_key }]
            $table->json('social_links_es')->nullable();
            $table->json('social_links_en')->nullable();
            $table->json('social_links_fr')->nullable();

            // Copyright
            $table->string('copyright_text_es')->nullable();
            $table->string('copyright_text_en')->nullable();
            $table->string('copyright_text_fr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_pages');
    }
};
