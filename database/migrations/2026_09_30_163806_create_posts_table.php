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
            
            // Nullable user relation: on user delete, set null
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete()
                  ->comment('Author user id, null when user is deleted');
            
            // Nullable category relation: on category delete, set null
            $table->foreignId('category_id')
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete()
                  ->comment('Category id, null when category is deleted');
            
            $table->string('slug')->unique()->comment('Unique identifier for the post');
            $table->string('cover')->nullable()->comment('Path to the post cover image');
            $table->string('title')->comment('Post title');
            $table->longText('content')->nullable()->comment('Post content');
            $table->boolean('is_active')->default(true)->comment('Whether the post is active');
            $table->string('author')->nullable()->comment('Manual author name');
            $table->unsignedBigInteger('views')->default(0)->comment('Number of views/visits');
            $table->timestamp('last_visit_at')->nullable()->comment('Timestamp of the last visit');
            
            $table->timestamps();
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