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
            $table->string('logo');
            $table->string('style', 100);
            $table->string('birth_year', 10);
            $table->string('location', 255);
            $table->string('label', 100);
            $table->string('description');
            $table->string('staff');
            $table->string('spoken_languages');
            $table->string('link_fb');
            $table->string('link_ig');
            $table->string('link_yt');
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
