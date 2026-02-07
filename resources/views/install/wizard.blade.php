@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto rounded-3xl p-6 bg-white/70 dark:bg-slate-900/60">
    <h1 class="text-2xl font-bold mb-4">Installation Wizard</h1>
    <form method="post" action="{{ route('install.store') }}" class="space-y-3">
        @csrf
        <input name="license_key" class="w-full rounded-xl border p-2" placeholder="License key" />
        <button class="px-4 py-2 rounded-xl bg-indigo-600 text-white">Activate</button>
    </form>
</div>
@endsection
