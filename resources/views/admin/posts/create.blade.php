@extends('layouts.main')

@section('pageTitle')
Crea nuovo post 
@endsection

@section('main')
<form action="{{route('admin.posts.store')}}" method="POST">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
  </div>
  <div class="form-group">
    <label for="date">Date</label>
    <input type="date" class="form-control" id="date" name="date" placeholder="Date">
  </div>

  <button type="submit" class="btn btn-primary">Crea</button>
</form>

@endsection

@section('css')

@endsection