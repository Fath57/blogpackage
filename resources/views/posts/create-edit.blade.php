@extends("layout.default")
@section("content")
<form action="{{route($post?"fath.posts.update":"fath.posts.store")}}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="title">Titre du post</label>
                <input id="title" type="text" name="title" class="form-control" value="{{old("name")}}"/>
            </div>
            <div class="form-group">
                <label for="summary">Un petit resumé</label>
                <textarea name="summary" id="summary" cols="30" rows="5" class="form-control">{{old('summary')}}</textarea>
            </div>
            <div class="form-group">
                <label for="body">Contenu de votre poste</label>
                <textarea name="body" id="body" cols="30" rows="15" class="form-control">{{old('body')}}</textarea>
            </div>
            <div class="form-group">
                <label for="key_words">Mot clé</label>
                <input name="key_words" id="key_words" value="{{old('key_words')}}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="category">Catégorie</label>
                <select name="fath_post_category_id" id="category">
                    @foreach($categories as $category)
                        @if(isset($post))
                        <option selected="{{$post->fath_post_category_id==$category->id?'selected':''}}" value="{{$category->id}}">{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image"> choisissez une image</label>
                <input type="file" multiple name="images" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{$post?"Mettre à jour le post":"Enrégistrer le poste"}}</button>
            </div>
        </div>
    </div>

</form>
@endsection