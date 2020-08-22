<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);

        $this->authorizeResource(Post::class, 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest  $request
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        return $request->user()
                       ->posts()
                       ->create($request->only([
                           'title',
                           'message',
                       ]));
    }

    /**
     * Display the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show')->with(compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function edit(Post $post)
    {
        return view('post.edit')->with(compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreRequest  $request
     * @param  Post  $post
     * @return mixed
     * @throws
     */
    public function update(StoreRequest $request, Post $post)
    {
        $post->fill($request->only([
            'title',
            'message',
        ]))->save();

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     * @throws
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('/');
    }
}
