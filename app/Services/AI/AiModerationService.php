<?php

namespace App\Services\AI;

use Illuminate\Support\Facades\Http;

class AiModerationService
{
    public function toxicityScore(string $content): float
    {
        $response = Http::withToken(config('services.huggingface.key'))
            ->post('https://api-inference.huggingface.co/models/unitary/toxic-bert', ['inputs' => $content])
            ->json();

        return (float) data_get($response, '0.0.score', 0.0);
    }

    public function autoTags(string $content): array
    {
        $prompt = "Return JSON array of max five short tags for forum content: {$content}";

        $response = Http::withToken(config('services.openai.key'))
            ->post('https://api.openai.com/v1/responses', [
                'model' => 'gpt-4.1-mini',
                'input' => $prompt,
            ])->json();

        return json_decode(data_get($response, 'output.0.content.0.text', '[]'), true) ?: [];
    }
}
