<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Report')</title>
    @vite(['resources/css/app.css'])
    <style>@media print { .no-print { display: none; } }</style>
</head>
<body class="bg-white p-6">
    @yield('content')
</body>
</html>
