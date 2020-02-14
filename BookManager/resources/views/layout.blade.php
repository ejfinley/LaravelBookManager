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
  
  <!-- nav bar -->
  <div class="navbar navbar-dark bg-dark">
      <div class="col-xs-12 col-sm-6 offset-sm-3 col-md-6 offset-md-3">

        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="/">See All Books</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/api/books/create">Add a Book</a>
          </li>
        </ul>
        
      </div>
  </div>
  <!-- nav bar ends here -->
  <div class="container">
    @yield('content')
  </div>
  <!--Footer section for future Exporting -->
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>