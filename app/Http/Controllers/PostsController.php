<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }
    public function search(request $request)
    {
        $search = $request->get('search');
        $posts = Post::find('title', 'like','%'.$search.'%');
        return view('post.index')->with('posts', $posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('cover_image'))
         {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->cover_image->storeAs('public/cover_images', $fileNameToStore); 

        }
        else 
            {
                $fileNameToStore = 'noimage.jpg';
            }
           
        
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();
        return redirect('/posts')->with('success', 'Post Created in this moment!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $post = Post::find($id);
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Not page');
        }
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required',
            'cover_image'=> 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('cover_image'))
         {
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            $filename = pathInfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->cover_image->storeAs('public/cover_images', $fileNameToStore); 

        }
      
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if($request->hasFile('cover_image'))
        {
            $post->cover_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/posts')->with('success', 'Post Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        // Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Not page');
        }

        if($post->cover_image != 'noimage.jpg')
        {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Removed');
        
    }
}
