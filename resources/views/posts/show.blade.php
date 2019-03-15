@extends('layouts.app')

@section('content')
<a href="{{route('posts.index')}}" class="btn btn-danger">Back</a>
<h2>post info</h2>
<p><h4>title :</h4>{{$post->title}} </p>
<p><h4>description :</h4>{{$post->description}} </p>
<h2>post creator info</h2>
<p><h4>name :</h4>{{ isset($post->user) ? $post->user->name : 'Not Found'}} </p>
<p><h4>email:</h4>{{ isset($post->user) ? $post->user->email : 'Not Found'}} </p>
<p><h4>created at:</h4>{{$post->created_at->format('l jS  M  G:i:s A Y')}} </p>


@endsection