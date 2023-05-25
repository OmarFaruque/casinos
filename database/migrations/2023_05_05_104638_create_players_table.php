<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->date('date')->useCurrent();
            $table->string('casino_bonus_lookup')->default('');
            $table->string('type')->default('');
            $table->string('group')->default('');
            $table->string('payment_method')->default('');
            $table->integer('deposit')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('balance')->default(0);
            $table->string('status', 60)->default('all-paid');
            $table->integer('partpaid')->default(0);
            $table->integer('fainalpaid')->default(0);
            $table->string('game_played', 100)->default('');
            $table->integer('spin')->default(0);
            $table->string('rtp', 60)->default(0);
            $table->string('worker', 60)->default('');
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
