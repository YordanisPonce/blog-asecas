<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            if (!Schema::hasColumn('contacts', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('contacts', 'subject')) {
                $table->string('subject')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('contacts', 'consent_privacy')) {
                $table->boolean('consent_privacy')->default(false)->after('message');
            }
            if (!Schema::hasColumn('contacts', 'consent_commercial')) {
                $table->boolean('consent_commercial')->default(false)->after('consent_privacy');
            }
            if (!Schema::hasColumn('contacts', 'lang')) {
                $table->string('lang', 2)->nullable()->after('consent_commercial');
            }
            if (!Schema::hasColumn('contacts', 'ip')) {
                $table->string('ip')->nullable()->after('lang');
            }
            if (!Schema::hasColumn('contacts', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip');
            }
        });
    }

    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'subject',
                'consent_privacy',
                'consent_commercial',
                'lang',
                'ip',
                'user_agent',
            ]);
        });
    }
};
