@extends('layout')

@section('content')
<div class="card text-center mx-auto" style="width: 18rem;">
  <div class="card-body">
    <form method="get" action="{{ route('books.export') }}"}>
      <div class="form-group">
        <label for="format">Export Format:</label>
        <select class="form-control" name="format">
          <option value="xml">XML</option>
          <option value="csv">CSV</option>
        </select>
      </div>
      <div class="form-group">
        <label for="format">Filter Data:</label>
        <select class="form-control" name="filter">
          <option value="title">Title</option>
          <option value="author">Author</option>
          <option value="both">Both</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Export Data</button>
    </form>
  </div>
</div>
@endsection