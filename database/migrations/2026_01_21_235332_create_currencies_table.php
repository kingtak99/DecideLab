<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('code', 10);       // JOD, SAR, EGP...
            $table->string('symbol', 10);     // د.أ, ر.س...
            $table->string('name_en', 50);
            $table->string('name_ar', 50);
            $table->decimal('rate_to_usd', 12, 4)->nullable(); // اختياري للتحويل لاحقًا
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('currencies');
    }
};
