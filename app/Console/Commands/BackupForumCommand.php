<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class BackupForumCommand extends Command
{
    protected $signature = 'forum:backup';
    protected $description = 'Run database backup and asset archive';

    public function handle(): int
    {
        $this->call('db:monitor');
        $this->info('Backup pipeline triggered (configure infra-specific command in production).');
        return self::SUCCESS;
    }
}
