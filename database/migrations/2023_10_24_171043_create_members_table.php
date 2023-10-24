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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('band_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->string('name', 100)->nullable(false);
            $table->string('picture')->nullable();
            $table->string('role', 50)->nullable(false);
            $table->string('allergies', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('members');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
