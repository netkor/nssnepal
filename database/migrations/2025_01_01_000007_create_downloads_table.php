<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('downloads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('file_path');
            $table->enum('type', ['publication', 'report'])->default('publication');
            $table->text('description')->nullable();
            $table->string('authors')->nullable();
            $table->string('journal')->nullable();
            $table->year('year')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->integer('download_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('downloads');
    }
};
