<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('subtitle')->nullable(); // "Lime mortar", "Mixed Line Mortar", etc.
            $table->string('image')->nullable();
            $table->json('image_alt')->nullable();
            $table->json('image_title')->nullable();

            // Información técnica
            $table->text('composition_en')->nullable();
            $table->text('composition_es')->nullable();
            $table->text('composition_fr')->nullable();

            $table->text('features_en')->nullable();
            $table->text('features_es')->nullable();
            $table->text('features_fr')->nullable();

            $table->text('recommendations_en')->nullable();
            $table->text('recommendations_es')->nullable();
            $table->text('recommendations_fr')->nullable();

            $table->text('carriers_en')->nullable();
            $table->text('carriers_es')->nullable();
            $table->text('carriers_fr')->nullable();

            $table->text('relevant_info_en')->nullable();
            $table->text('relevant_info_es')->nullable();
            $table->text('relevant_info_fr')->nullable();

            // Especificaciones
            $table->string('presentation')->nullable(); // "25 kg bags"
            $table->string('pallet_info')->nullable(); // "Pallet of 1600 kg (56 bags)"
            $table->string('storage_info')->nullable(); // "12 months from manufacturing date"

            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabla para documentos
        Schema::create('product_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('name'); // "AENOR Certificate", "Technical Sheet", etc.
            $table->string('file_path');
            $table->string('file_type')->nullable(); // pdf, doc, etc.
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_documents');
        Schema::dropIfExists('products');
    }
};