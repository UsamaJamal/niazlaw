<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->string('linkedin_url')->nullable()->after('phone');
            $table->string('profile_pdf')->nullable()->after('linkedin_url');
        });
    }

    public function down(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->dropColumn(['linkedin_url', 'profile_pdf']);
        });
    }
};
