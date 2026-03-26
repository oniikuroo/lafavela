<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_sections', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 5);
            $table->string('page', 20);
            $table->string('title', 160);
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();

            $table->index(['lang', 'page']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_sections');
    }
};
