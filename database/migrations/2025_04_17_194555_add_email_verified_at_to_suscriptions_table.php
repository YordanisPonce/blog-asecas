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
        Schema::table('subscription_emails', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable();
            $table->string('email_verified_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('subscription_emails', function (Blueprint $table) {
            $table->dropColumn(['email_verified_at', 'email_verified_token']);
        });
    }
};
