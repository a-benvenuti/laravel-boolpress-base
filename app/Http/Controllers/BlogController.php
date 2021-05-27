<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Tag;

class BlogController extends Controller
{
    public function index()
    {
        // prendo i dati dal db (5 post di quelli pubblicati ordinati dal più datati)
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->limit(5)->get();
        // restituisco la pagina home
        return view('guest.index', compact('posts'));
    }

    public function show($slug)
    {
        // prendo i dati dal db
        $post = Post::where('slug', $slug)->first();

        // se lo slug non è presente pagina 404
        if ($post == null) {
            abort(404);
        }
        // restituisco la pagina del post
        return view('guest.show', compact('post'));
    }


    public function addComment(Request $request, Post $post)
    {
        // validazione
        $request->validate([
            'name' => 'nullable|string|max:100',
            'content' => 'required|string',
        ]);

        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;

        $newComment->save();

        return back();
    }

}
