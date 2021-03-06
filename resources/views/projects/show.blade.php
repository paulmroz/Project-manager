@extends('layouts.app')

@section('content')
    <header class="flex items-center mb-2 py-1">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey-dark font-normal">
                <a href="/projects" class="text-grey-dark font-normal no-underline">My projects</a>
                / {{$project->title}}
            </p>

            <div class="flex items-center">
                @foreach($project->members as $member)
                    <img src="{{gravatars_url($member->email)}}" alt="{{$member->name}}'s avatar"
                         class="rounded-full w-8 mr-1">
                @endforeach

                <img src="{{gravatars_url($project->owner->email)}}" alt="{{$project->owner->name}}'s avatar"
                     class="rounded-full w-8 mr-1">

                <a href="{{$project->path().'/edit'}}" class="button">Edit Project</a>

            </div>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-6">
                    <h2 class="text-lg text-grey-dark font-normal mb-3">Tasks</h2>

                    @foreach($project->tasks as $task)
                        <div class="card mb-3">
                            <form action="{{$project->path(). '/tasks/'.$task->id  }}" method="post">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input class="w-full border-0 {{$task->completed ? 'text-grey': ''}}" type="text"
                                           name="body" value="{{$task->body}}">
                                    <input type="checkbox" name="completed"
                                           onchange="this.form.submit()" {{ $task->completed ? 'checked': ''}}>
                                </div>
                            </form>
                        </div>
                    @endforeach
                    <div class="card mb-3">
                        <form action="{{$project->path().'/tasks'}}" method="POST">
                            @csrf
                            <input name="body" type="text" placeholder="Add a new task..." class="w-full border-0">
                        </form>
                    </div>
                </div>
                <div>
                    <h2 class="text-lg text-grey-dark font-normal mb-3">General Notes</h2>
                    <form action="{{$project->path()}}" method="post">
                        @csrf
                        @method('PATCH')
                        <textarea class="card w-5/6 mb-6" name="notes">{{$project->notes}}</textarea>
                        <div>
                            <button type="submit" class="button">Save</button>
                        </div>

                    </form>
                    @include('errors')
                </div>
            </div>

            <div class="lg:w-1/4 px-3">
                @include('projects.card')

                @include('projects.activity.card')

                @can('manage', $project)
                    @include('projects.invite')
                @endcan
            </div>
        </div>
    </main>


@endsection
