@extends('layouts.app')

@section('content')
>
   <form action="{{route('posts.destroy',$post->id)}}" method="POST">
       @csrf
       @method('delete')
      

   <button type="submit" class="btn btn-primary">delete</button>
   </form>

@endsection
