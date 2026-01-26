<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('loan_rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');

            $table->decimal('default_interest_rate', 5, 2)->nullable();  // %
            $table->decimal('max_interest_rate', 5, 2)->nullable();      // %
            $table->decimal('max_installment_ratio', 5, 2)->nullable();  // مثل 0.33 أو 0.45

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('loan_rules');
    }
};
