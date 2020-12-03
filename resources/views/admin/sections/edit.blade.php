@extends('layout')

@section('content')

    @include('show_err') 
    <form method="POST" 
            action="{{ route('sections.update', $section) }}"
            class="project">
        
        @method('PATCH')
         
        @include('admin.sections.form',[
            'btnText' => 'Save',
            'section' => $section
        ])

    </form>
@endsection