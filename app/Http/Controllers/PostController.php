<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        return Post::all();
    }
 
    public function show($id)
    {
        return Post::find($id);
    }

    public function store(Request $request)
    {
        return Post::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $Post = Post::findOrFail($id);
        $Post->update($request->all());

        return $Post;
    }

    public function delete(Request $request, $id)
    {
        $Post = Post::findOrFail($id);
        $Post->delete();

        return 204;
    }
}
