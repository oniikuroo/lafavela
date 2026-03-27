<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_pages', function (Blueprint $table) {
            $table->id();
            $table->string('locale', 5);
            $table->string('page', 20);
            $table->longText('payload');
            $table->timestamps();

            $table->unique(['locale', 'page']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_pages');
    }
};
