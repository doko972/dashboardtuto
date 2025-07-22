<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HRTélécoms')</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body data-theme="pink" data-mode="light">

    <div class="notification-container" id="notificationContainer"></div>

    <div class="container">
        <main class="main-content" role="main">
            @include('partials.header')
            @yield('content')
        </main>
    </div>

    @include('partials.footer')

</body>
</html>
