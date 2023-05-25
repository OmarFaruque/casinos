<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Fixed top navbar example · Bootstrap v5.1</title>

    @vite('resources/css/app.css')

</head>
<body>
    
    @include('layouts.partials.navbar')

    <main class="mx-auto flex {{ !auth()->user() ? 'justify-center' : ''; }}">
        @include('layouts.partials.sidebar')
        
        @yield('content')
        
    </main>
      
    @vite('resources/js/app.js')
  </body>
</html>