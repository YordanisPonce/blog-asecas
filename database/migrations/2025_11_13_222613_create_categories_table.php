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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->json('image_alt')->nullable(); // {en: '', es: '', fr: ''}
            $table->json('image_title')->nullable(); // {en: '', es: '', fr: ''}
            $table->text('short_description_en')->nullable();
            $table->text('short_description_es')->nullable();
            $table->text('short_description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_es')->nullable();
            $table->text('description_fr')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
