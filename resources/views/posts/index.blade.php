@extends('layouts.app')

@section('content')
<a href="{{route('posts.create')}}" class="btn btn-success">Create Post</a>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
      <th scope="col">posted_by</th>
      <th scope="col">Created_at</th>
      <th scope="col">slug</th>
      <th scope="col">show</th>
     
     
    </tr>
  </thead>
  <tbody>
    @foreach($posts as $post)
    <tr>
      <th scope="row">{{$post->id}}</th>
      <td>{{$post->title}}</td>
     
      <td>{{ isset($post->user) ? $post->user->name : 'Not Found'}}</td>
      <td>{{$post->created_at->format('d/m/Y')}}</td>
      <td>{{$post->slug}}</td>
      <td> 

      <a href="{{route('posts.show',$post->id)}}" class="btn btn-primary">show</a> 
<a href="{{route('posts.edit',$post->id)}}" class="btn btn-secondary">edit</a>
<form action="{{route('posts.destroy',$post->id)}}" method="POST">
       @csrf
       @method('delete')
      <!-- <a href="{{route('posts.destroy',$post->id)}}" class="btn btn-danger">delete</a> </td> -->
      <button onclick="myFunction()" id="profileclick" type="submit" class="btn btn-danger">Delete</button>
      <script>
function myFunction() {
  alert("are you shore to delete");
}
</script>

   </form>

    </tr>
    @endforeach

  </tbody>
</table>
@endsection