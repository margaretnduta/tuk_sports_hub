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
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
Schema::create('events', function (Blueprint $table) {
    $table->id();
    $table->foreignId('coach_id')->constrained('coaches')->cascadeOnDelete();
    $table->string('title');
    $table->string('sport_type')->index();
    $table->dateTime('starts_at');
    $table->dateTime('ends_at')->nullable();
    $table->string('location');
    $table->text('description')->nullable();
    $table->string('cover_image')->nullable();
    $table->timestamps();
});
