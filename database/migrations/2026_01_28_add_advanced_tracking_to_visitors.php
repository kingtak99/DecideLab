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
        Schema::table('visitors', function (Blueprint $table) {
            // Country detection
            $table->string('country')->nullable()->after('user_agent');
            $table->string('country_code')->nullable()->after('country');
            
            // Session tracking
            $table->string('session_id')->nullable()->after('country_code');
            $table->unsignedInteger('session_duration')->default(0)->after('session_id'); // in seconds
            
            // Page-level tracking
            $table->string('page_title')->nullable()->after('url');
            $table->string('referrer')->nullable()->after('page_title');
            
            // Indices for performance
            $table->index('country');
            $table->index('session_id');
            $table->index('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            $table->dropIndex(['country']);
            $table->dropIndex(['session_id']);
            $table->dropIndex(['url']);
            
            $table->dropColumn(['country', 'country_code', 'session_id', 'session_duration', 'page_title', 'referrer']);
        });
    }
};
