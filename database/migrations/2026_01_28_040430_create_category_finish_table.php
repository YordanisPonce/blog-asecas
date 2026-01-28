<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_finish', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('finish_id')->constrained('finishes')->cascadeOnDelete();

            // orden del acabado dentro de la categoría
            $table->unsignedInteger('order')->default(0);

            $table->timestamps();

            $table->unique(['category_id', 'finish_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_finish');
    }
};
