<?php

use App\Models\Patchlist;
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
        Schema::create('patchlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('member_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->integer('number')->nullable(false);
            $table->string('instrument', 100)->nullable(false);
            $table->string('microphone', 50)->nullable(false);
            $table->enum('microphone_stand', Patchlist::ENUM)->nullable(false);
            $table->string('color', 10)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('patchlists');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
