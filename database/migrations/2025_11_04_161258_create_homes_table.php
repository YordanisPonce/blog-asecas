<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->text('first_description_es')->nullable();
            $table->text('first_description_en')->nullable();
            $table->text('first_description_fr')->nullable();

            $table->string('first_image_alt_es')->nullable();
            $table->string('first_image_alt_en')->nullable();
            $table->string('first_image_alt_fr')->nullable();

            $table->string('first_image_title_es')->nullable();
            $table->string('first_image_title_en')->nullable();
            $table->string('first_image_title_fr')->nullable();

            $table->text('sencond_title_es')->nullable();
            $table->text('sencond_title_en')->nullable();
            $table->text('sencond_title_fr')->nullable();

            $table->text('sencond_description_es')->nullable();
            $table->text('sencond_description_en')->nullable();
            $table->text('sencond_description_fr')->nullable();

            $table->text('third_title_es')->nullable();
            $table->text('third_title_en')->nullable();
            $table->text('third_title_fr')->nullable();

            $table->text('third_description_en')->nullable();
            $table->text('third_description_es')->nullable();
            $table->text('third_description_fr')->nullable();

            $table->string('second_image_alt_es')->nullable();
            $table->string('second_image_alt_en')->nullable();
            $table->string('second_image_alt_fr')->nullable();

            $table->string('second_image_title_en')->nullable();
            $table->string('second_image_title_es')->nullable();
            $table->string('second_image_title_fr')->nullable();

            $table->text('inspiration_text_en')->nullable();
            $table->text('inspiration_text_es')->nullable();
            $table->text('inspiration_text_fr')->nullable();

            $table->json('inspiration_images_en')->nullable();
            $table->json('inspiration_images_es')->nullable();
            $table->json('inspiration_images_fr')->nullable();

            $table->text('blog_text_en')->nullable();
            $table->text('blog_text_es')->nullable();
            $table->text('blog_text_fr')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homes');
    }
};
