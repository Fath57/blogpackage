@extends('layout.default)
@section("content")
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{$post->images[0]->path}}" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title">{{$post->title}}</h5>
                        <p class="card-text">{{$post->summary}}</p>
                        <a href="{{route('fath.posts.detail',$post->id)}}" class="btn btn-primary">Consulter</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
