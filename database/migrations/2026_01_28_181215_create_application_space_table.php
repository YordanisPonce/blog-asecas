<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('application_space', function (Blueprint $table) {
            $table->id(); // <- clave para Relation Manager cómodo
            $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();
            $table->foreignId('application_id')->constrained('applications')->cascadeOnDelete();

            $table->unsignedInteger('order')->default(0);
            $table->timestamps();

            $table->unique(['space_id', 'application_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_space');
    }
};
