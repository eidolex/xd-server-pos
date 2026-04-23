<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("two_d_games", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("game_time_id")->constrained("two_d_game_times");
            $table->timestamp("release_date");
            $table->string("status", 20)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("two_d_games");
    }
};
