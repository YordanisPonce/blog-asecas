<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();

            // i18n (ES base)
            $table->string('title');
            $table->string('title_en')->nullable();
            $table->string('title_fr')->nullable();

            $table->string('slug')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->string('slug_fr')->nullable()->unique();

            $table->longText('description')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_fr')->nullable();

            // Media
            $table->string('image')->nullable(); // path en disk public o URL completa
            $table->json('image_alt')->nullable();
            $table->json('image_title')->nullable();

            // SEO
            $table->json('seo_title')->nullable();
            $table->json('seo_description')->nullable();

            // Flags
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
