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
        Schema::table('players', function (Blueprint $table) {            
            $table->string('payment_method')->change();
            $table->integer('deposit')->change();
            $table->integer('bonus')->change();
            $table->integer('balance')->change();
            $table->integer('partpaid')->change();
            $table->integer('fainalpaid')->change();
            $table->integer('spin')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            //
        });
    }
};
