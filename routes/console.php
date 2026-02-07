<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('forum:seed-demo', function (): void {
    $this->call('db:seed', ['--class' => 'Database\\Seeders\\DemoContentSeeder']);
})->describe('Seed demo forum content for trials');
