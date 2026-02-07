<div class="rounded-3xl p-5 bg-white/70 dark:bg-slate-900/60 shadow-xl space-y-3">
    <h2 class="font-semibold">Start a thread</h2>
    <select wire:model="category_id" class="w-full rounded-xl border p-2">
        <option value="">Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>
    <input wire:model="title" class="w-full rounded-xl border p-2" placeholder="Thread title" />
    <textarea wire:model="body_markdown" rows="6" class="w-full rounded-xl border p-2" placeholder="Markdown body"></textarea>
    <div class="flex gap-2">
        <button wire:click="suggest" class="px-4 py-2 rounded-xl bg-violet-600 text-white">AI Suggest</button>
        <button wire:click="save" class="px-4 py-2 rounded-xl bg-emerald-600 text-white">Publish</button>
    </div>
    @if($aiSuggestion)
        <div class="rounded-xl bg-slate-100 dark:bg-slate-800 p-3 text-sm">{{ $aiSuggestion }}</div>
    @endif
</div>
