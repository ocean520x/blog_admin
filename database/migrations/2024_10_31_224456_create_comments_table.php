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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->comment('评论的作者');
            $table->foreignId('topic_id')->constrained()->onDelete('cascade')->comment('评论的帖子');
            $table->foreignId('reply_comment_id')->nullable()->constrained('comments')->onDelete('cascade')->comment('被回复评论的id');
            $table->foreignId('reply_user_id')->nullable()->constrained('users')->onDelete('cascade')->comment('被回复评论的作者id');
            $table->text('content')->comment('评论内容');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
