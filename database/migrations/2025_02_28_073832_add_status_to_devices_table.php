<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->boolean('status')->default(1)->after('name'); // 1 = Enabled, 0 = Disabled
        });
    }

    public function down()
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};

