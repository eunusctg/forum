@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
@livewire('admin.analytics-cards')
<a href="{{ route('admin.moderation.index') }}" class="underline">Moderation Queue</a>
@endsection
