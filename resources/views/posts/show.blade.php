@extends("layout.default")
@section('content')
    <div class="container">
        <img src="{{$post->images[0]->path}}" alt="{{$post->title}}">
        <div class="row">
            <h4 class="text-danger">{{$post->title}}</h4>
            <div>{{$post->body}}</div>
        </div>
    </div>

    <div class="container">
        @foreach($post->comments as $comment)
        <div class="bg-dark row">
            {{$comment->content}}
            <div class="col-md-12">
                <span class="float-right">{{$comment->author->name}}</span>
            </div>
        </div>
            @endforeach
            <form action="{{route('faths.comments.store')}}">
                @csrf
                <input type="hidden" value="{{$post->id}}" name="post_id">
                <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
                <input type="submit" class="btn btn-primary" value="Commenter">
            </form>
    </div>
@endsection