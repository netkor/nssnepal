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
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('research_gate_url')->nullable()->after('phone');
            $table->string('google_scholar_url')->nullable()->after('research_gate_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->dropColumn(['phone', 'research_gate_url', 'google_scholar_url']);
        });
    }
};
