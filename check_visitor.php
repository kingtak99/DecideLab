<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

$visitors = \App\Models\Visitor::limit(5)->get();
foreach ($visitors as $v) {
    echo "IP: {$v->ip_address} | Country: {$v->country} | Code: {$v->country_code}\n";
}
