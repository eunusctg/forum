<?php

namespace App\Livewire\Forum;

use App\Models\Category;
use App\Models\Thread;
use App\Services\AI\AiAssistantService;
use Livewire\Component;

class ThreadComposer extends Component
{
    public string $title = '';
    public string $body_markdown = '';
    public int $category_id = 0;
    public string $aiSuggestion = '';

    public function suggest(AiAssistantService $assistant): void
    {
        $this->aiSuggestion = $assistant->suggestReply($this->body_markdown);
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|min:8|max:180',
            'body_markdown' => 'required|min:20',
            'category_id' => 'required|exists:categories,id',
        ]);

        Thread::create([
            'title' => $this->title,
            'body_markdown' => $this->body_markdown,
            'body_html' => app('markdown')->convert($this->body_markdown)->getContent(),
            'category_id' => $this->category_id,
            'user_id' => auth()->id(),
            'slug' => str($this->title)->slug() . '-' . str()->random(6),
        ]);

        $this->redirectRoute('home');
    }

    public function render()
    {
        return view('livewire.forum.thread-composer', ['categories' => Category::orderBy('position')->get()]);
    }
}
