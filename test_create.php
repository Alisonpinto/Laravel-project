<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    $user = App\Models\User::where('role', 'student')->first();
    if (!$user) {
        echo "No student user found.\n";
        exit;
    }
    
    $achievement = $user->achievements()->create([
        'title' => 'Test Title',
        'category' => 'Internship',
        'description' => 'Test Desc',
        'file_path' => 'test.pdf',
        'status' => 'pending',
    ]);
    
    echo "Created successfully: " . $achievement->id . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
