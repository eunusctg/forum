<!doctype html>
<html lang="en" x-data="{dark: window.matchMedia('(prefers-color-scheme: dark)').matches}" :class="dark ? 'dark' : ''">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'ForumOS') }}</title>
    <meta name="description" content="AI-enabled community forum" />
    <meta property="og:title" content="ForumOS" />
    <meta property="og:type" content="website" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-slate-100 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen">
<header class="sticky top-0 backdrop-blur-xl bg-white/60 dark:bg-slate-900/60 border-b border-white/20">
    <div class="max-w-7xl mx-auto p-4 flex justify-between">
        <a href="{{ route('home') }}" class="font-bold">ForumOS</a>
        <nav class="space-x-4"><a href="/admin">Admin</a><a href="/install">Install</a></nav>
    </div>
</header>
<main class="max-w-7xl mx-auto p-6">@yield('content')</main>
@livewireScripts
</body>
</html>
