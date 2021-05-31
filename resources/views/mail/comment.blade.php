<h1>Nuovo Commento</h1>
<div>
    <span>Un utente ha commentato il seguente post: {{$post->title}}</span>
    <a href="{{route('admin.posts.show', ['post' => $post->id])}}">Visualizza il post</a>
</div>