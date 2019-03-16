<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\Post\StorePostRequest;
class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(3);
        // return PostResource::collection(Post::all());//see all posts
        return PostResource::collection($posts);//select only 3
     
    } 
    public function show($post)
    {
        $post=Post::findOrFail($post);
        return new PostResource($post);
    }
    public function store(StorePostRequest $request)
    {
        Post::create($request->all());

        return response()->json([
            'message' => 'Post Created Successfully'
        ],201);
    }
    
}
