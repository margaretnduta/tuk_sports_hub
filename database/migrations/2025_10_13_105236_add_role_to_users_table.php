<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('users', function (Blueprint $t) {
        $t->enum('role', ['admin', 'coach', 'player', 'fan'])->default('fan')->after('password');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $t) {
        $t->dropColumn('role');
    });
}

};
