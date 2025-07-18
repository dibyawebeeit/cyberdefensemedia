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
        Schema::create('cms_home', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->nullable();
            $table->integer('block_id')->nullable();
            $table->integer('feed_id')->nullable();
            $table->integer('items')->nullable();
            $table->integer('title_length')->nullable();
            $table->integer('desc_length')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_home');
    }
};
