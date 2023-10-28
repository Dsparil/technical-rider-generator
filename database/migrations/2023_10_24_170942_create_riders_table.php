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
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('band_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->string('title', 100)->nullable(false);
            $table->string('font', 50)->nullable();
            $table->text('scene_map_json')->nullable();
            $table->text('scene_map_snapshot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('riders');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
