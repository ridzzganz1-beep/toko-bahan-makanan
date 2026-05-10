<?php
require __DIR__ . '/vendor/autoload.php';
$app = require __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();
$users = App\Models\User::select('name', 'email', 'role')->get();
foreach ($users as $user) {
    echo $user->name . ' | ' . $user->email . ' | ' . $user->role . PHP_EOL;
}
