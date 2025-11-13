<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {

        Schema::dropIfExists('applications');
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->json('image_alt')->nullable();
            $table->json('image_title')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_es')->nullable();
            $table->text('short_description_fr')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_es')->nullable();
            $table->text('description_fr')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Tabla pivote para relación many-to-many
        Schema::create('application_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->unique(['application_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('application_category');
        Schema::dropIfExists('applications');
    }
};