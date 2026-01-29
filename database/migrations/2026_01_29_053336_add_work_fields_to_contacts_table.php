<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'type')) {
                $table->string('type')->default('contact')->after('user_agent');
                // si user_agent no existe, cámbialo por after('message') o lo que tengas
            }

            if (!Schema::hasColumn('contacts', 'speciality')) {
                $table->string('speciality')->nullable()->after('subject');
            }

            if (!Schema::hasColumn('contacts', 'cv_path')) {
                $table->string('cv_path')->nullable()->after('speciality');
            }

            if (!Schema::hasColumn('contacts', 'cv_original_name')) {
                $table->string('cv_original_name')->nullable()->after('cv_path');
            }

            if (!Schema::hasColumn('contacts', 'cv_mime')) {
                $table->string('cv_mime')->nullable()->after('cv_original_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'type',
                'speciality',
                'cv_path',
                'cv_original_name',
                'cv_mime',
            ]);
        });
    }
};
