<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\posts_admin_blog;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = posts_admin_blog::all();
    
        if ($posts->isEmpty()) {
            return view('blog.blog')->with('error', 'No hay registros en la base de datos.');
        }
    
        return view('blog.blog', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Add validation for other fields as needed
        ]);

        blog::create($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post =blog::find($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = blog::find($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            // Add validation for other fields as needed
        ]);

        $post = blog::find($id);
        $post->update($request->all());

        return redirect()->route('posts.index')
            ->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = blog::find($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully');
    }
}
