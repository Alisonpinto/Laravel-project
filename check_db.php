<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$achievements = App\Models\Achievement::all();
echo "Count: " . $achievements->count() . "\n";
print_r($achievements->toArray());
