<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>{{__('Casino')}}</title>

    @vite('resources/css/app.css')

</head>
<body class="overflow-x-hidden">
    
    @include('layouts.partials.navbar')

    <main class="mx-auto min-h-screen  w-full overflow-y-hidden {{ !auth()->user() ? 'justify-center' : ''; }}">
        <div class="flex overflow-x-hidden {{ !auth()->user() ? 'justify-center' : ''; }}">
            @auth
                <div id="leftSidebar" style="min-width: 200px;" class="bg-dark position-relative relative text-white bg-gray-800 top-0 left-0 z-40 w-64 min-h-screen h-full p-4 overflow-y-auto transition-transform -translate-x-half dark:bg-gray-800 table-cell">
                    @include('layouts.partials.sidebar')
                </div>
            @endauth
            <div class="block overflow-x-hidden w-full">
                @yield('content')
            </div>
        </div>
        
    </main>
      
    @vite('resources/js/app.js')
  </body>
</html>