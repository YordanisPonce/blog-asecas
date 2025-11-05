<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();

            // Media
            $table->string('image_path')->nullable(); // storage/app/public/product-categories/...

            // Slug y orden/estado
            $table->string('slug')->unique();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            // Títulos
            $table->string('title_es')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            // Descripción
            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();

            // Subdescripción (texto corto bajo el título)
            $table->string('subdescription_es')->nullable();
            $table->string('subdescription_en')->nullable();
            $table->string('subdescription_fr')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
