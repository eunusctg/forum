<?php

use App\Http\Controllers\Api\ThreadUpdateController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (): void {
    Route::post('/threads/{thread}/summarize', [ThreadUpdateController::class, 'summarize']);
});
