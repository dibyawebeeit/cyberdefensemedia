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
        Schema::create('aboutus', function (Blueprint $table) {
            $table->id();
            $table->string('title1')->nullable();
            $table->text('desc1')->nullable();
            $table->string('image1',100)->nullable();
            $table->string('cta_title')->nullable();
            $table->string('cta_button_text',100)->nullable();
            $table->string('cta_button_url',100)->nullable();
            $table->string('cta_bg_image',100)->nullable();
            $table->string('title2')->nullable();
            $table->text('desc2')->nullable();
            $table->string('image2',100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aboutus');
    }
};
