<!DOCTYPE html>
<html>

<head>
    <title>ROOM 911</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="antialiased bg-slate-100 dark:bg-slate-900">
    <header>
        @include('partials.nav')
    </header>

    @include('partials._show-status')
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    @livewireScripts
</body>

</html>
