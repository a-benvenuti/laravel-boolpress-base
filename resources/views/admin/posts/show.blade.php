@extends('layouts.main')

@section('pageTitle')
{{$post->title}}
@endsection

@section('main')

<h1>{{$post->title}}</h1>
<p><strong>data:</strong> {{$post->date}}</p>
<p><strong>stato:</strong> {{$post->published ? 'pubblicato' : 'non pubblicato'}}</p>
<div>
	<strong>Tags:</strong>
	@foreach ($post->tags as $tag)
	<span class="badge badge-info">{{$tag->name}}</span>
	@endforeach
</div>
<hr>
<p>{{$post->content}}</p>

@if ($post->comments->isNotEmpty())
<div class="mt-5">
	<h3>Commenti</h3>
	<ul>
		@foreach ($post->comments as $comment)
			<li>
				<h5>{{$comment->name ? $comment->name : 'Anonimo'}}</h5>
				<p>{{$comment->content}}</p>
				<div>
					<form action="{{route('admin.comments.destroy', [ 'comment' => $comment->id ])}}" method="POST">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-danger">Elimina Commento</button>
					</form>
				</div>
			</li>
			<hr>
		@endforeach
	</ul>
</div>
@endif
<a href="{{route('admin.posts.index')}}">Torna alla lista degli articoli</a>

@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		{{-- <span aria-hidden="true">&times;</span> --}}
	</button>
</div>
@endif

@endsection

@section('css')

@endsection