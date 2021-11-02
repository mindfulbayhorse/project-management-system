@extends('layout')

@section('content')
    @include('show_err') 
    <form method="POST" 
            action="{{ route('roles.update', ['role'=> $role]) }}">
        
        @method('PATCH')
        @include('admin.roles.form',[
            'btnText' => 'Save',
            'role' => $role
        ])

    </form>
@endsection