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
        Schema::create("two_d_bet_items", function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->foreignUuid("two_d_bet_id")->constrained("two_d_bets");
            $table->uuid("group_key");
            $table->string("input_number", 30);
            $table->string("number", 2);
            $table->integer("bet_amount");
            $table->integer("return_amount")->nullable();
            $table->integer("win_amount")->nullable();
            $table->string("status", 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("two_d_bet_items");
    }
};
