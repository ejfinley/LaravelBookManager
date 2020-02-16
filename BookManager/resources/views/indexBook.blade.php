@extends('layout')

@section('content')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <table class="table table-striped table-bordered">
    <thead>
        <tr>
          <td>@sortablelink('title')</td>
          <td>@sortablelink('Author')</td>
          <td>Edit Author </td>
          <td>Delete</td>
        </tr>
    </thead>
    <tbody>
        @foreach($books as $book)
        <tr>
            <td>{{$book->title}}</td>
            <td>{{$book->author}}</td>
            <td><a href="{{ route('books.edit', $book->id)}}" class="btn btn-primary" dusk="edit-button-{{$book->id}}">Edit</a></td>
            <td>
                <form action="{{ route('books.destroy', $book->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit" dusk="delete-button-{{$book->id}}">
                      <i class="far fa-trash-alt"></i>
                  </button>
                </form>
           </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  {!! $books->appends(\Request::except('page'))->render() !!}
<div>
@endsection