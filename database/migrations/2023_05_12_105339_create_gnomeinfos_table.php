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
        Schema::create('gnomeinfos', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->string('country', 60)->default('');
            $table->string('code', 100)->default('');
            $table->string('worker', 100)->default('');
            $table->string('email')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnomeinfos');
    }
};
