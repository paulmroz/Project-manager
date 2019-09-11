@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-2 py-1">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-dark font-normal">
                <a href="/projects" class="text-grey-dark font-normal no-underline">My projects</a> / {{$project->title}}
            </p>

            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-6">
                    <h2 class="text-lg text-grey-dark font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                    <div class="card mb-3">
                        {{$task->body}}
                    </div>
                    @endforeach
                    <div class="card mb-3">
                        Lorem ipsum.
                    </div>
                </div>
                <div>
                    <h2 class="text-lg text-grey-dark font-normal mb-3">General Notes</h2>
                    <textarea class="card w-5/6">
                        Lorem ipsum.
                    </textarea>
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
               @include('projects.card')
            </div>
        </div>
    </main>


@endsection
