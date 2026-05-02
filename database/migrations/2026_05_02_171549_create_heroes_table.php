<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->id();
            $table->string('tag')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('bg')->nullable();
            $table->string('btn1')->nullable();
            $table->string('btn2')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('heroes');
    }
};
