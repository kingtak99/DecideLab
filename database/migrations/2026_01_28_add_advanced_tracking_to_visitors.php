<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Country detection
            if (!Schema::hasColumn('visitors', 'country')) {
                $table->string('country')->nullable()->after('user_agent');
            }
            if (!Schema::hasColumn('visitors', 'country_code')) {
                $table->string('country_code')->nullable()->after('country');
            }
            
            // Session tracking
            if (!Schema::hasColumn('visitors', 'session_id')) {
                $table->string('session_id')->nullable()->after('country_code');
            }
            if (!Schema::hasColumn('visitors', 'session_duration')) {
                $table->unsignedInteger('session_duration')->default(0)->after('session_id'); // in seconds
            }
            
            // Page-level tracking
            if (!Schema::hasColumn('visitors', 'page_title')) {
                $table->string('page_title')->nullable()->after('url');
            }
            if (!Schema::hasColumn('visitors', 'referrer')) {
                $table->string('referrer')->nullable()->after('page_title');
            }
        });

        // Add indices safely
        $this->addIndicesIfNotExist();
    }

    /**
     * Add indices if they don't exist
     */
    private function addIndicesIfNotExist(): void
    {
        $indexes = DB::select("SHOW INDEX FROM `visitors` WHERE Key_name IN ('visitors_country_index', 'visitors_session_id_index')");
        $existingIndexes = collect($indexes)->pluck('Key_name')->toArray();

        Schema::table('visitors', function (Blueprint $table) use ($existingIndexes) {
            if (!in_array('visitors_country_index', $existingIndexes)) {
                $table->index('country');
            }
            if (!in_array('visitors_session_id_index', $existingIndexes)) {
                $table->index('session_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            // Drop indices
            $table->dropIndexIfExists('visitors_country_index');
            $table->dropIndexIfExists('visitors_session_id_index');
            
            // Drop columns
            if (Schema::hasColumn('visitors', 'country')) {
                $table->dropColumn('country');
            }
            if (Schema::hasColumn('visitors', 'country_code')) {
                $table->dropColumn('country_code');
            }
            if (Schema::hasColumn('visitors', 'session_id')) {
                $table->dropColumn('session_id');
            }
            if (Schema::hasColumn('visitors', 'session_duration')) {
                $table->dropColumn('session_duration');
            }
            if (Schema::hasColumn('visitors', 'page_title')) {
                $table->dropColumn('page_title');
            }
            if (Schema::hasColumn('visitors', 'referrer')) {
                $table->dropColumn('referrer');
            }
        });
    }
};
