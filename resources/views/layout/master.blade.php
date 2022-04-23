<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>@yield('title')</title>
</head>
<body class="bg-gradient-to-r from-cyan-400 to-blue-500">
<div class="flex font-mono">
    <a href="{{route('home')}}">
        <p class="p-2 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-blue-900 to-cyan-600">Wonder Place</p>
    </a>
</div>
<div class="font-mono text-cyan-700/90">
    @yield('content')
</div>
</body>
</html>
