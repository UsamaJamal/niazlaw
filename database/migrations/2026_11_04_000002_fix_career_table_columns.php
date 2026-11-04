<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (Schema::hasTable('career_settings')) {
            Schema::table('career_settings', function (Blueprint $table) {
                if (!Schema::hasColumn('career_settings', 'attorney_overview')) $table->longText('attorney_overview')->nullable();
                if (!Schema::hasColumn('career_settings', 'attorney_advancement')) $table->longText('attorney_advancement')->nullable();
                if (!Schema::hasColumn('career_settings', 'staff_overview')) $table->longText('staff_overview')->nullable();
                if (!Schema::hasColumn('career_settings', 'staff_advancement')) $table->longText('staff_advancement')->nullable();
                if (!Schema::hasColumn('career_settings', 'application_email')) $table->string('application_email')->nullable();
                if (!Schema::hasColumn('career_settings', 'created_at')) $table->timestamps();
            });
        }

        if (Schema::hasTable('career_openings')) {
            Schema::table('career_openings', function (Blueprint $table) {
                if (!Schema::hasColumn('career_openings', 'track')) $table->string('track')->nullable();
                if (!Schema::hasColumn('career_openings', 'title')) $table->string('title')->nullable();
                if (!Schema::hasColumn('career_openings', 'location')) $table->string('location')->nullable();
                if (!Schema::hasColumn('career_openings', 'active')) $table->boolean('active')->default(true);
                if (!Schema::hasColumn('career_openings', 'created_at')) $table->timestamps();
            });
        }
    }

    public function down()
    {
    }
};
