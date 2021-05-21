<?php

use Illuminate\Contracts\Console\Kernel;

require_once __DIR__.'/../vendor/autoload.php';

if (env('DB_CONNECTION') == 'sqlite') {
    if (!file_exists(__DIR__.'/../'.env('DB_DATABASE'))) {
        file_put_contents(__DIR__.'/../'.env('DB_DATABASE'), "");
    }
}

/*
|--------------------------------------------------------------------------
| Bootstrap The Test Environment
|--------------------------------------------------------------------------
|
| You may specify console commands that execute once before your test is
| run. You are free to add your own additional commands or logic into
| this file as needed in order to help your test suite run quicker.
|
*/


$commands = [
    'key:generate',
    'cache:clear',
    'config:cache',
    'view:clear',
    'migrate:fresh',
//    'db:seed --class="RolesTableSeeder"',
//    'db:seed --class="CategoriesTableSeeder"',
//    'db:seed --class="UsersTableSeeder"',
//    'db:seed --class="BookingsTableSeeder"',
//    'db:seed --class="ReviewsTableSeeder"',
//    'db:seed --class="FaqsTableSeeder"',
    'event:cache',
];

$app = require __DIR__.'/../bootstrap/app.php';

$console = tap($app->make(Kernel::class))->bootstrap();

foreach ($commands as $command) {
    $console->call($command);
}
