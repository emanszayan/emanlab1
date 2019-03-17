<?php

namespace App\Http\Controllers;
use App\Http\Requests\post\StorePostRequest;
use App\Http\Requests\post\UpdatePostRequest;

use Illuminate\Http\Request;
use App\Post;//use mode post or table  post
use App\User;//use table user

class PostsController extends Controller
{
   
    public function index()
    {
        //  dd(Post::all()); //call all in table post(model post)
        //send this parameter to fn index in view in parameter posts

        return view('posts.index', [
            // 'posts' => Post::all()
            'posts' => Post::with('User')->get()

        ]);
    }
    public function destroy(Post $post)
    {
        //  dd(Post::all());
        $post->delete();
        return view('posts.index', [
            // 'posts' => Post::all()
             'posts' => Post::all()

        ]);
        
    }
     
    public function show(Post $post)
    {
        //  dd(Post::all());

        return view('posts.show', [
            'post' =>$post
            // 'users' => $users
        ]);
    }


    public function create()
    {
        $users = User::all();
        return view('posts.create',[
            'users' => $users,
        ]);
    }

    public function store(StorePostRequest $request)
    {
        //     $request->validate([
        //         'title'=>'required|min:3',
        //         'description'=>'required|min:10'
        //     ],
        // [
        //     'title.required'=>'should enter title',
        //     'title.min'=>'should enter more than min'
        // ]

        Post::create(request()->all());

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        // dd($post->user_id);
        // dd($post);
        // $post = Post::where('id',$post)->get()->first();
        // select * from posts where id=1 limit 1;
        // $post = Post::where('id',$post)->first();
        // $post = Post::findorfail($post);
        $users= User :: all();
        return view('posts.edit', [
            'post' => $post,
            'users' => $users,
        ]);
    }
    public function update(UpdatePostRequest $request,Post $post)
    {
    
        $post->update(['title'=>$request->title,'descriptions'=>$request->description]);

        
        // Post::update(request()->all());
        // Post::where('id', $post)->update(Input::all());
        return redirect()->route('posts.index');
    }

}
