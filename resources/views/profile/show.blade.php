@extends('layout')

@section('content')
    <h1>User Profile</h1>
    @php $avatarUrl = $avatarUrl ?? null; @endphp

    <div>
        <h3>{{ $user->name }}</h3>
        <p>{{ $user->email }}</p>

        @if ($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="Profile Photo">
        @else
            <p>No profile photo available</p>
        @endif
    </div>
@endsection
