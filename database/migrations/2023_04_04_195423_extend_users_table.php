<?php

namespace PixiiBomb\Essentials\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(USERS, function (Blueprint $table) {
            $table->renameColumn('name', 'username');
            $table->string('avatar')->nullable()->after('password');
            $table->string('role')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(USERS, function (Blueprint $table) {
            $table->renameColumn('username', 'name');
            $table->dropColumn('avatar');
            $table->dropColumn('role');
        });
    }
};
