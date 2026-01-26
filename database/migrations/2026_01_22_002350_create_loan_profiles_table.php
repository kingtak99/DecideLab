<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('loan_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->string('loan_type'); // personal, housing, car, etc
            $table->enum('interest_system', ['flat', 'compound_monthly', 'compound_yearly', 'apr', 'murabaha']);
            $table->decimal('interest_rate', 5, 2)->nullable(); // %
            $table->integer('min_years')->default(1);
            $table->integer('max_years')->default(30);
            $table->decimal('processing_fee', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('loan_profiles');
    }
};
