<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$users = DB::table('users')->select('id','email','is_admin')->get();
foreach ($users as $u) {
    echo $u->id . ' | ' . $u->email . ' | is_admin=' . ($u->is_admin ? '1' : '0') . PHP_EOL;
}
