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
        // Projects already successfully migrated before the crash
        // Schema::table('projects', function (Blueprint $table) {
        //     $table->index('is_active');
        //     $table->index('status');
        //     $table->index('is_featured');
        // });

        Schema::table('news_events', function (Blueprint $table) {
            $table->index('is_published');
            $table->index('type');
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->index('is_active');
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->index('type');
            $table->index('year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
            $table->dropIndex(['status']);
            $table->dropIndex(['is_featured']);
        });

        Schema::table('news_events', function (Blueprint $table) {
            $table->dropIndex(['is_published']);
            $table->dropIndex(['type']);
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->dropIndex(['is_active']);
        });

        Schema::table('downloads', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropIndex(['year']);
        });
    }
};
