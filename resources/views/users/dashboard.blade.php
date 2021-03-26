@extends('layouts.three_columns')

@section('left_section')

    <nav>
    
        <ul>
            <li><a href="{{ $user->profile('edit') }}">Edit profile</a></li>
            <li><a href="{{ $user->profile('show') }}">Profile review</a></li>
            <li><a href="{{ $user->profile() }}" class="active">Dashboard</a></li>
        </ul>
        
    </nav>
    
@endsection

@section('center_section')

    @unless (auth()->user()->isNot($user))
        You are in the profile dashboard!
    @endunless
    
@endsection