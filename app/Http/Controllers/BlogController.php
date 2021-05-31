<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Tag;
use Illuminate\Support\Facades\Mail;
use App\Mail\CommentMail;

class BlogController extends Controller
{
    public function index()
    {
        // prendo tutti i tag
        $tags = Tag::all();

        // prendo i dati dal db (5 post di quelli pubblicati ordinati dal più datati)
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->limit(5)->get();

        // restituisco la pagina home
        return view('guest.index', compact('posts', 'tags'));
    }

    public function show($slug)
    {
        // prendo tutti i tag
        $tags = Tag::all();

        // prendo i dati dal db
        $post = Post::where('slug', $slug)->first();

        // se lo slug non è presente pagina 404
        if ($post == null) {
            abort(404);
        }
        // restituisco la pagina del post
        return view('guest.show', compact('post', 'tags'));
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

        // invio l'email di notifica
        Mail::to('mail@mail.it')->send(new CommentMail($post));

        return back();
    }

    public function filterTag($slug)
    {
        // prendo tutti i tag
        $tags = Tag::all();

        // prendo i dati dal db
        $tag = Tag::where('slug', $slug)->first();

        // se lo slug non è presente pagina 404
        if ($tag == null) {
            abort(404);
        }

        // prendo tutti i post con quel tag tra i post pubblicati
        $posts = $tag->posts()->where('published', 1)->get();

        // restituisco la pagina home
        return view('guest.index', compact('posts', 'tags'));
    }

}
