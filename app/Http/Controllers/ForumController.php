<?php

namespace App\Http\Controllers;

use App\Events\ThreadUpdated;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\StoreThreadRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Thread;
use App\Services\AI\AiModerationService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function __construct(private readonly AiModerationService $ai) {}

    public function home(): View
    {
        return view('forum.home', [
            'categories' => Category::with('children')->orderBy('position')->get(),
            'threads' => Thread::with('user', 'category')->latest()->paginate(20),
        ]);
    }

    public function showThread(Thread $thread): View
    {
        $thread->increment('views');

        return view('forum.thread-show', ['thread' => $thread->load('posts.user')]);
    }

    public function storeThread(StoreThreadRequest $request): RedirectResponse
    {
        $toxicityScore = $this->ai->toxicityScore($request->string('body_markdown')->toString());
        abort_if($toxicityScore > 0.85, 422, 'Content flagged by AI moderation.');

        $thread = DB::transaction(fn () => Thread::create([
            ...$request->validated(),
            'user_id' => $request->user()->id,
            'body_html' => app('markdown')->convert($request->string('body_markdown'))->getContent(),
            'slug' => str($request->string('title'))->slug() . '-' . str()->random(6),
            'ai_tags' => $this->ai->autoTags($request->string('body_markdown')->toString()),
        ]));

        broadcast(new ThreadUpdated($thread))->toOthers();

        return redirect()->route('thread.show', $thread->slug)->with('status', 'Thread posted.');
    }

    public function storePost(StorePostRequest $request, Thread $thread): RedirectResponse
    {
        Post::create([
            ...$request->validated(),
            'thread_id' => $thread->id,
            'user_id' => $request->user()->id,
            'body_html' => app('markdown')->convert($request->string('body_markdown'))->getContent(),
        ]);

        broadcast(new ThreadUpdated($thread->fresh()))->toOthers();

        return back()->with('status', 'Reply added.');
    }
}
