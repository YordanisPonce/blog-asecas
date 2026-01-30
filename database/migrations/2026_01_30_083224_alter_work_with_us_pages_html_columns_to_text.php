<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE work_with_us_pages
                MODIFY hero_title_es TEXT NULL,
                MODIFY hero_title_en TEXT NULL,
                MODIFY hero_title_fr TEXT NULL,

                MODIFY section_title_es TEXT NULL,
                MODIFY section_title_en TEXT NULL,
                MODIFY section_title_fr TEXT NULL,

                MODIFY checkbox_1_label_es TEXT NULL,
                MODIFY checkbox_1_label_en TEXT NULL,
                MODIFY checkbox_1_label_fr TEXT NULL,

                MODIFY checkbox_2_label_es TEXT NULL,
                MODIFY checkbox_2_label_en TEXT NULL,
                MODIFY checkbox_2_label_fr TEXT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE work_with_us_pages
                MODIFY hero_title_es VARCHAR(255) NULL,
                MODIFY hero_title_en VARCHAR(255) NULL,
                MODIFY hero_title_fr VARCHAR(255) NULL,

                MODIFY section_title_es VARCHAR(255) NULL,
                MODIFY section_title_en VARCHAR(255) NULL,
                MODIFY section_title_fr VARCHAR(255) NULL,

                MODIFY checkbox_1_label_es VARCHAR(255) NULL,
                MODIFY checkbox_1_label_en VARCHAR(255) NULL,
                MODIFY checkbox_1_label_fr VARCHAR(255) NULL,

                MODIFY checkbox_2_label_es VARCHAR(255) NULL,
                MODIFY checkbox_2_label_en VARCHAR(255) NULL,
                MODIFY checkbox_2_label_fr VARCHAR(255) NULL
        ");
    }
};
