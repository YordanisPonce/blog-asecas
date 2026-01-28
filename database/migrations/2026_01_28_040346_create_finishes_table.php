<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finishes', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('slug')->unique();

            $table->string('name_en')->nullable();
            $table->string('slug_en')->nullable()->index();

            $table->string('name_fr')->nullable();
            $table->string('slug_fr')->nullable()->index();

            $table->text('description_es')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_fr')->nullable();

            // Imagen (igual que category/product: guardas path o URL)
            $table->string('image')->nullable();

            $table->json('image_alt')->nullable();
            $table->json('image_title')->nullable();

            // Badges (los iconitos con etiquetas)
            $table->json('badges')->nullable();

            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finishes');
    }
};
