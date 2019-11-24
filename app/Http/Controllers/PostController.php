<?php

namespace App\Http\Controllers;

use Gate;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('published', true)->paginate(20);
        return view('posts.index', compact('posts'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:posts'],
            'body' => ['required', 'max:200'],
        ]);
        if ($request->isMethod('post')) {
            $data = $request->only('title', 'body');
            $data['slug'] = Str::slug($data['title']);
            $data['user_id'] = Auth::user()->id;
            $post = Post::create($data);
        }
        return redirect()->route('edit_post', ['id' => $post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('published', true)->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => ['required', 'unique:posts'],
        ]);
        $data = $request->only('title', 'body');
        $data['slug'] = Str::slug($data['title']);
        $post->fill($data)->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);

    }

    public function drafts()
    {
//        $drafts = Post::where('published', false)->paginate(20);

        $draftsQuery = Post::where('published', false);

        if (Gate::denies('see-all-drafts')){
            $draftsQuery = $draftsQuery->where('user_id', Auth::user()->id);
        }
        $drafts = $draftsQuery->get();

        return view('posts.drafts', compact('drafts'));
    }
}
