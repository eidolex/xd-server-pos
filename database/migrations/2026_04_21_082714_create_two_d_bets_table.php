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
        Schema::create("two_d_bets", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("two_d_game_id")->constrained("two_d_games");
            $table->foreignUuid("user_id")->constrained("users");
            $table->foreignUuid("creator_id")->constrained("users");
            $table->integer("commission_percentage");
            $table->integer("total_bet_amount");
            $table->integer("total_return_amount")->nullable();
            $table->integer("total_win_amount")->nullable();
            $table->integer("total_commission_amount")->nullable();
            $table->string("status", 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("two_d_bets");
    }
};
