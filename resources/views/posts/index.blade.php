<h1>Showing all Posts</h1>
<table class="table">
    <thead>
    <tr>
        <th>Titre</th>
        <th>Image</th>
        <th>Resumé</th>
        <th>Contenu</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
@forelse ($posts as $post)
  <tr>
      <td>{{$post->title}}</td>
      <td><img src="{{$post->images[0]->path}}" alt=""></td>
      <td>{{$post->summary}}</td>
      <td>{{$post->content}}</td>
      <td>
          <a class="btn btn-primary" href="{{route('fath.posts.edit',$post->id)}}"></a>
          <a class="btn btn-danger" href="{{route('fath.posts.delete',$post->id)}}"></a>
      </td>
  </tr>
@empty
    <p> 'No posts yet' </p>
@endforelse
    </tbody>
</table>