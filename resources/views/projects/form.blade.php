<div>
    <label>Title</label>
    <div>
        <input type="text" name="title" value="{{$project->title}}"></input>
    </div>

</div>

<div>
    <label>Description</label>
    <div>
        <input type="text" name="description" value="{{$project->description}}"></input>
    </div>
</div>

<button type="submit">{{$buttonText}}</button>

<a href="{{$project->path()}}">Cancel</a>

@include('errors')




