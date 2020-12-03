@extends('layout')

@section('content')
    @include('show_err') 
    <form method="POST" 
            action="{{ route('sections.index') }}"
            class="project">
          
        @include('admin.sections.form',[
            'btnText' => 'Create',
            'section' => new App\Models\SectionTitle()
        ])

    </form>
@endsection