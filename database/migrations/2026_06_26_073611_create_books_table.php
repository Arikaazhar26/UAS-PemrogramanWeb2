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
    Schema::create('books', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')
              ->constrained('categories')
              ->cascadeOnUpdate()
              ->restrictOnDelete();

        $table->string('title', 200);
        $table->string('author', 100);
        $table->string('publisher', 100);
        $table->year('publish_year');
        $table->string('isbn', 30)->unique();
        $table->integer('stock')->default(0);
        $table->string('cover')->nullable();
        $table->text('description')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
