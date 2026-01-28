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
        Schema::table('finishes', function (Blueprint $table) {
            foreach (['short_description_es', 'short_description_en', 'short_description_fr'] as $col) {
                if (Schema::hasColumn('finishes', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    public function down(): void
    {
        Schema::table('finishes', function (Blueprint $table) {
            $table->text('short_description_es')->nullable();
            $table->text('short_description_en')->nullable();
            $table->text('short_description_fr')->nullable();
        });
    }
};
