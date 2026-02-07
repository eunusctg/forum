<?php

namespace App\Services\AI;

use App\Models\Thread;
use Illuminate\Support\Facades\Http;

class AiAssistantService
{
    public function summarizeThread(Thread $thread): string
    {
        $content = $thread->posts()->latest()->limit(30)->pluck('body_markdown')->implode("\n\n");

        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/responses', [
                'model' => 'gpt-4.1-mini',
                'input' => "Summarize this thread in 5 bullets:\n{$content}",
            ])->json();

        return (string) data_get($response, 'output.0.content.0.text', 'Summary unavailable.');
    }

    public function suggestReply(string $context): string
    {
        $response = Http::withToken(config('services.openai.key'))->post('https://api.openai.com/v1/responses', [
            'model' => 'gpt-4.1-mini',
            'input' => "Draft a helpful, concise forum reply:\n{$context}",
        ])->json();

        return (string) data_get($response, 'output.0.content.0.text', '');
    }
}
