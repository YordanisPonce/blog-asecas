<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('final_title_es')->nullable();
            $table->string('final_title_en')->nullable();
            $table->string('final_title_fr')->nullable();

            $table->text('final_description_es')->nullable();
            $table->text('final_description_en')->nullable();
            $table->text('final_description_fr')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            //
        });
    }
};
