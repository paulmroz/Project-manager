@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3 py-2">
        <div class="flex justify-between items-end w-full">
            <h2 class="text-grey-dark font-normal">My projects</h2>

            <a href="/projects/create" class="button" @click.prevent="$modal.show('new-project')">New Project</a>
        </div>
    </header>


    <div class="lg:flex lg:flex-wrap -mx-3">
        @forelse($projects as $project)
            <div class="lg:w-1/3 px-3 pb-6">
                @include('projects.card')
            </div>
        @empty
            <div>No projects yet.</div>
        @endforelse
    </div>

    <new-project-modal></new-project-modal>

@endsection
