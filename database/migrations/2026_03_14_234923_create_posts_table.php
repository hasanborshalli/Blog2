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
        Schema::create('posts', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();
    $table->foreignId('category_id')->constrained()->cascadeOnDelete();
    $table->foreignId('approved_by')->nullable()->constrained('users')->nullOnDelete();

    $table->string('title');
    $table->string('slug')->unique();
    $table->text('excerpt')->nullable();
    $table->longText('content');
    $table->string('featured_image')->nullable();

    $table->string('status')->default('draft');
    $table->text('rejection_reason')->nullable();

    $table->timestampTz('published_at')->nullable();
    $table->timestampTz('approved_at')->nullable();

    $table->string('meta_title')->nullable();
    $table->text('meta_description')->nullable();

    $table->unsignedBigInteger('views_count')->default(0);

    $table->timestampsTz();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};