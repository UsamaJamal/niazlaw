<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->string('designation', 255)->nullable()->after('title');
        });

        DB::table('attorneys')->where('title', 'Senior Counsel')->update([
            'designation' => 'Founder & Managing Attorney | Niaz Law Group',
        ]);
    }

    public function down(): void
    {
        Schema::table('attorneys', function (Blueprint $table) {
            $table->dropColumn('designation');
        });
    }
};
