<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$log = fopen('seed_debug_log.txt', 'w');

try {
    fwrite($log, "Starting migration...\n");
    // Force force to avoid interactive confirmation
    $exitCode = \Illuminate\Support\Facades\Artisan::call('migrate:refresh', ['--seed' => true, '--force' => true]);
    fwrite($log, "Exit Code: $exitCode\n");
    fwrite($log, "Output: " . \Illuminate\Support\Facades\Artisan::output());
} catch (\Throwable $e) {
    fwrite($log, "Error: " . $e->getMessage() . "\n");
    fwrite($log, $e->getTraceAsString());
}
fclose($log);
