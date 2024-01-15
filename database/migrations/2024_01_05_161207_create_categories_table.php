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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->treeColumns();
            $table->string('slug');
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->string('background')->nullable();
            $table->string('description')->nullable();
            $table->string('x_icon')->nullable();
            $table->string('image')->nullable();
            $table->json('facilities')->nullable();
            $table->timestamps();
        });

        Schema::create('categorizables', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();

            $table->morphs('categorizable');

            $table->unique(['category_id', 'categorizable_id', 'categorizable_type'], 'unique_category_assign');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorizables');
        Schema::dropIfExists('categories');
    }
};
