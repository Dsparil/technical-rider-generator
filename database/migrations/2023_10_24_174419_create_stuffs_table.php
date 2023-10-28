<?php

use App\Models\Stuff;
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
        Schema::create('stuffs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rider_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->foreignId('member_id')->nullable(false)->constrained()->onDelete('cascade');
            $table->enum('section', Stuff::ENUM)->nullable(false);
            $table->string('label', 50)->nullable(true);
            $table->string('content')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('stuffs');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
};
