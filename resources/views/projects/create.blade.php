@extends('layouts.app')

@section('content')

    <h1>Create a Project</h1>

    <form method="POST" action="/projects">
        @csrf

        <div>
            <label>Title</label>
            <div>
                <input type="text" name="title"></input>
            </div>

        </div>

        <div>
            <label>Description</label>
            <div>
                <input type="text" name="description"></input>
            </div>
        </div>

        <button type="submit">Create</button>

        <a href="/projects">Cancel</a>
    </form>

@endsection

