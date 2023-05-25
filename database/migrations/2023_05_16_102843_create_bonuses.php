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
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('casino_lookup')->default('');
            $table->integer('casino_name')->default(0);
            $table->integer('gnome')->default(0);
            $table->smallInteger('prtn')->default(0);
            $table->integer('group')->default(0);
            $table->integer('deposit')->nullable();
            $table->integer('bonus')->nullable();
            $table->string('wagering_name')->nullable();
            $table->integer('wagering_value')->nullable();
            $table->string('payment_methods')->nullable();
            $table->text('country_banned');
            $table->smallInteger('gnome_done_casino')->nullable();  //last time gnome done casino
            $table->smallInteger('anyone_done_casino')->nullable(); // last time anyone done casino 
            $table->smallInteger('anyone_done_group')->nullable(); // last time anyone done group
            $table->integer('gnome_pending_payout')->nullable(); //Pending Payouts for Gnome in this Group
            $table->integer('everyone_pending_payout')->nullable(); //Total Pending Payouts for Everyone for this Group
            $table->integer('everyone_sub_pending_payout')->nullable(); //SUB Pending Payouts for Everyone in this Group
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bonuses');
    }
};
