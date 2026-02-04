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
        Schema::create('visitor_stats_snapshots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('period_start')->index();
            $table->dateTime('period_end')->index();
            $table->integer('total')->default(0);
            $table->integer('human')->default(0);
            $table->integer('trusted')->default(0);
            $table->integer('social')->default(0);
            $table->integer('unique_visitors_human')->default(0);
            $table->decimal('trusted_ratio', 5, 2)->nullable();
            $table->decimal('social_ratio', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_stats_snapshots');
    }
};
