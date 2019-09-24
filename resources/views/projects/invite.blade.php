<div class="card flex flex-col mt-12">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-blue pl-4">
        Invite a user
    </h3>

    <form method="post" action="{{$project->path() . '/invitations'}}">
        @csrf

        <input type="email" name="email" placeholder="Email address">
        <button type="submit"  class="button text-xs">Invite</button>
    </form>
    @include('errors',['bag' => 'invitations'])
</div>
