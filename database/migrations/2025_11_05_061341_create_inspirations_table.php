<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_inspirations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('inspirations', function (Blueprint $table) {
            $table->id();

            // Ruta del archivo subido (public/storage/inspirations/...)
            $table->string('image_path')->nullable();

            // Metadatos por idioma
            $table->string('title_es')->nullable();
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            $table->string('alt_es')->nullable();
            $table->string('alt_en')->nullable();
            $table->string('alt_fr')->nullable();

            // Orden manual y estado
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inspirations');
    }
};
