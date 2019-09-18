@extends('layouts.app')

@section('content')

    <h1>Edit your project</h1>

    <form method="POST" action="{{$project->path()}}">
        @csrf
        @method('PATCH')

        @include('projects.form', ['buttonText'=>'Update Project'])

    </form>
@endsection

