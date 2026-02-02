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
            if (!Schema::hasColumn('visitors', 'page_views')) {
                $table->unsignedInteger('page_views')->default(1)->after('session_duration');
            }

            if (!Schema::hasColumn('visitors', 'has_scroll')) {
                $table->boolean('has_scroll')->default(false)->after('page_views');
            }

            if (!Schema::hasColumn('visitors', 'is_social')) {
                $table->boolean('is_social')->default(false)->after('has_scroll');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitors', function (Blueprint $table) {
            if (Schema::hasColumn('visitors', 'page_views')) {
                $table->dropColumn('page_views');
            }
            if (Schema::hasColumn('visitors', 'has_scroll')) {
                $table->dropColumn('has_scroll');
            }
            if (Schema::hasColumn('visitors', 'is_social')) {
                $table->dropColumn('is_social');
            }
        });
    }
};
