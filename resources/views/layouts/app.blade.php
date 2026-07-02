<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Exam & Results</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('partials.sidebar')

    <div class="app-main">
        @include('partials.topbar')

        <main class="app-content">
            @include('partials.alerts')
            @yield('content')
        </main>
    </div>

    <div id="sidebar-overlay" class="fixed inset-0 z-30 hidden bg-slate-900/60 lg:hidden" onclick="toggleSidebar()"></div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.toggle('hidden');
        }
    </script>
</body>
</html>
