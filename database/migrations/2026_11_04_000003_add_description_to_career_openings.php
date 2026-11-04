<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(){Schema::table('career_openings',function(Blueprint $t){$t->longText('description')->nullable();});} public function down(){Schema::table('career_openings',function(Blueprint $t){$t->dropColumn('description');});} };
