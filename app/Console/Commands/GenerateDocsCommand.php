<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateDocsCommand extends Command
{
    protected $signature = 'forum:generate-docs';
    protected $description = 'Generate product documentation snapshot';

    public function handle(): int
    {
        $path = base_path('docs/generated.md');
        File::put($path, "# ForumOS Docs\nGenerated: ".now()->toIso8601String());
        $this->info("Generated {$path}");
        return self::SUCCESS;
    }
}
