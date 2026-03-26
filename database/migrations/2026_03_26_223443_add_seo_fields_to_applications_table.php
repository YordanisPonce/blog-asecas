<?php
// database/migrations/xxxx_xx_xx_xxxxxx_add_seo_fields_to_applications_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->string('meta_title_es')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_title_fr')->nullable();
            $table->text('meta_description_es')->nullable();
            $table->text('meta_description_en')->nullable();
            $table->text('meta_description_fr')->nullable();
            $table->text('meta_keywords_es')->nullable();
            $table->text('meta_keywords_en')->nullable();
            $table->text('meta_keywords_fr')->nullable();
            $table->string('og_title_es')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_title_fr')->nullable();
            $table->text('og_description_es')->nullable();
            $table->text('og_description_en')->nullable();
            $table->text('og_description_fr')->nullable();
            $table->string('og_image')->nullable();
        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title_es',
                'meta_title_en',
                'meta_title_fr',
                'meta_description_es',
                'meta_description_en',
                'meta_description_fr',
                'meta_keywords_es',
                'meta_keywords_en',
                'meta_keywords_fr',
                'og_title_es',
                'og_title_en',
                'og_title_fr',
                'og_description_es',
                'og_description_en',
                'og_description_fr',
                'og_image',
            ]);
        });
    }
};
