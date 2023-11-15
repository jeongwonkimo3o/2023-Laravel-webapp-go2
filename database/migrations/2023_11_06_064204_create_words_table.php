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
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->foreignId('title_id')->constrained('word_titles')->cascadeOnDelete();
            $table->string('word');
            $table->string('mean');
            $table->string('pos', 30)->nullable();
            $table->string('pronunciation')->nullable();
            $table->string('synonym')->nullable();
            $table->string('antonym')->nullable();
            $table->string('explain')->nullable();
            $table->string('lang', 50);
            $table->boolean('mark')->default(0); // 0: 단어를 모름
            $table->timestamps();

            // index
            $table->index(['word', 'mean', 'lang']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
