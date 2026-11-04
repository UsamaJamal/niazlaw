<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('career_settings', function (Blueprint $table) {
            $table->text('attorney_overview')->nullable();
            $table->text('attorney_advancement')->nullable();
            $table->text('staff_overview')->nullable();
            $table->text('staff_advancement')->nullable();
            $table->string('application_email')->nullable();
            $table->timestamps();
        });

        Schema::table('career_openings', function (Blueprint $table) {
            $table->string('track')->nullable();
            $table->string('title')->nullable();
            $table->string('location')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('career_settings', function (Blueprint $table) { $table->dropColumn(['attorney_overview','attorney_advancement','staff_overview','staff_advancement','application_email','created_at','updated_at']); });
        Schema::table('career_openings', function (Blueprint $table) { $table->dropColumn(['track','title','location','active','created_at','updated_at']); });
    }
};
