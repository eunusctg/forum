<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Services\AI\AiAssistantService;
use Illuminate\Http\JsonResponse;

class ThreadUpdateController extends Controller
{
    public function __construct(private readonly AiAssistantService $assistant) {}

    public function summarize(Thread $thread): JsonResponse
    {
        $this->authorize('view', $thread);
        return response()->json(['summary' => $this->assistant->summarizeThread($thread)]);
    }
}
