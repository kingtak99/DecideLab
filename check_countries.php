<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "Country IDs and currencies:\n";

$countries = App\Models\Country::select('id', 'name_en', 'currency_code')->take(25)->get();
foreach($countries as $country) {
    echo $country->id . ': ' . $country->name_en . ' (' . $country->currency_code . ')' . "\n";
}