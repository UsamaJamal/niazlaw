<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        if (!Schema::hasTable('career_settings')) {
            Schema::create('career_settings', function (Blueprint $t) {
                $t->id();
                $t->longText('attorney_overview')->nullable();
                $t->longText('attorney_advancement')->nullable();
                $t->longText('staff_overview')->nullable();
                $t->longText('staff_advancement')->nullable();
                $t->string('application_email')->nullable();
                $t->timestamps();
            });
        }

        if (!Schema::hasTable('career_openings')) {
            Schema::create('career_openings', function (Blueprint $t) {
                $t->id();
                $t->string('track')->nullable();
                $t->string('title')->nullable();
                $t->string('location')->nullable();
                $t->longText('description')->nullable();
                $t->boolean('active')->default(true);
                $t->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('career_openings');
        Schema::dropIfExists('career_settings');
    }
};
