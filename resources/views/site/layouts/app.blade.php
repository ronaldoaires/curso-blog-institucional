<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <meta name="description" content="@yield('description', config('app.description'))">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

</head>
<body>

@include('site.partials.header')

<main>
@yield('content')
</main>

@include('site.partials.footer')
    
</body>
</html>