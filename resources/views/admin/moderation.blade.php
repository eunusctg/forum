@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Moderation</h1>
@foreach($reports as $report)
<form class="rounded-2xl p-4 bg-white/70 dark:bg-slate-900/60 mb-3" method="post" action="{{ route('admin.moderation.update', $report) }}">
    @csrf
    @method('PUT')
    <p>{{ $report->reason }}</p>
    <select name="status" class="rounded border p-2">
        @foreach(['open','reviewing','resolved','dismissed'] as $status)
            <option @selected($report->status === $status)>{{ $status }}</option>
        @endforeach
    </select>
    <button class="px-3 py-2 bg-blue-600 text-white rounded">Save</button>
</form>
@endforeach
{{ $reports->links() }}
@endsection
