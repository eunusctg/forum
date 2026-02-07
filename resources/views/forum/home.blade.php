@extends('layouts.app')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    <section class="lg:col-span-2 space-y-4">
        @auth
            @livewire('forum.thread-composer')
        @endauth
        @foreach($threads as $thread)
            <article class="rounded-3xl p-5 bg-white/70 dark:bg-slate-900/60 shadow-xl ring-1 ring-white/20">
                <a href="{{ route('thread.show', $thread->slug) }}" class="text-xl font-semibold">{{ $thread->title }}</a>
                <p class="text-sm opacity-70">{{ $thread->user->username }} · {{ $thread->created_at->diffForHumans() }}</p>
            </article>
        @endforeach
        {{ $threads->links() }}
    </section>
    <aside class="space-y-4">
        @foreach($categories as $category)
            <div class="rounded-3xl p-4 bg-white/70 dark:bg-slate-900/60">{{ $category->name }}</div>
        @endforeach
    </aside>
</div>
@endsection
