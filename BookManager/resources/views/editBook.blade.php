@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Update Author
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    <form method="post" action="{{ route('books.update', $book->id) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="name">Book Title:</label>
              {{$book->title}}
          </div>
          <div class="form-group">
              <label for="price">Author :</label>
              <input type="text" class="form-control" name="author" value="{{ $book->author }}"/>
          </div>
          <button type="submit" class="btn btn-primary">Update Author</button>
      </form>
  </div>
</div>
@endsection