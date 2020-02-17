<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Book Manager</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  
  <!-- nav bar -->
  <nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <!-- nav bar Links-->
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="/">See All Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/api/books/create">Add a Book</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/api/books/exportoptions">Export Data</a>
      </li>
      <!-- nav bar Links ends here-->

    </ul>
    <!-- search bar -->
    <form class="form-inline ml-auto" method="get" action="{{ route('books.query') }}">
      <div class="md-form my-0">
        <input class="form-control" type="text" placeholder="Search Books" name="search" id='search'>
        <button type="submit" class="btn btn-default">
          <i class="fas fa-search text-white" name="searchButton" aria-hidden="true"></i>
        </button>
      </div>
    </form>
    <!-- search bar ends here-->
  </nav>
  <!-- nav bar ends here -->
  <div class="container">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>