<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('event');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('preview_body')->nullable();
            $table->longText('body')->nullable();
            $table->boolean('on_main')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->json('images')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entries');
    }
};
