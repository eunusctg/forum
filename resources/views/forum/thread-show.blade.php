@extends('layouts.app')

@section('content')
<article class="rounded-3xl bg-white/70 dark:bg-slate-900/60 p-6 mb-6">
    <h1 class="text-3xl font-bold">{{ $thread->title }}</h1>
    <div class="prose dark:prose-invert">{!! $thread->body_html !!}</div>
</article>
<section class="space-y-4">
    @foreach($thread->posts as $post)
        <div class="rounded-2xl bg-white/70 dark:bg-slate-900/60 p-4">
            <div class="text-sm opacity-70">{{ $post->user->username }}</div>
            <div class="prose dark:prose-invert">{!! $post->body_html !!}</div>
        </div>
    @endforeach
</section>
@endsection
