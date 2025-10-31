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
         Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_id'); // user id who posted
            $table->string('author_role')->default('teacher'); // 'admin' or 'teacher'
            $table->string('title');
            $table->text('body');
            $table->boolean('to_teachers')->default(false);
            $table->boolean('to_students')->default(false);
            $table->boolean('to_parents')->default(false);
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
