@extends('layout')

@section('content')
    @include('show_err') 
    <form method="POST" 
            action="{{ route('roles.index') }}">
          
        @include('admin.roles.form',[
            'btnText' => 'Create',
            'role' => new App\Models\Role()
        ])

    </form>
@endsection