<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;

class PostController extends Controller
{
    protected $validationRules = [
        //validation
            'title' => 'string | required | max:100 | min:1',
            'content' => 'string | required',
            'category_id' => 'nullable | exists:categories,id'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();  // -> SELECT * FROM Post

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate($this->validationRules);

        $newPost = new Post();
        $newPost->fill($request->all());

        $newPost->slug = $this->getSlug($request->title);

        $newPost->save();

        return redirect()->route('admin.posts.index')->with('success', "The post has been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
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
        //validation
        $request->validate($this->validationRules);

        if($post->title != $request->title) {

            $post->slug = $this->getSlug($request->title);
        }

        $post->fill($request->all());

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', "The post with id {$post->id} has been updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return string
     */
    public function destroy(Request $request)
    {
        $post = Post::find($request->id);

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', "The post with id {$post->id} has been deleted.");
    }

    /**
     * Returns a unique slug
     *
     * @param  string  $title
     * @return \Illuminate\Http\Response
     */
    private function getSlug($title) {
        $slug = Str::of($title)->slug('-');

        $postExist = Post::where('slug', $slug)->first();

        $count = 2;

        while ($postExist) {
            $slug = Str::of($title)->slug('-') . "-{$count}";
            $postExist = Post::where('slug', $slug)->first();
            $count++;
        }

        return $slug;
    }
}
