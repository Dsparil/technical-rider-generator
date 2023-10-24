<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('logo')->nullable();
            $table->string('style', 100)->nullable();
            $table->string('birth_year', 10)->nullable();
            $table->string('location', 255)->nullable();
            $table->string('label', 100)->nullable();
            $table->string('description')->nullable();
            $table->string('staff')->nullable();
            $table->string('spoken_languages')->nullable();
            $table->string('link_fb')->nullable();
            $table->string('link_ig')->nullable();
            $table->string('link_yt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('bands');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
