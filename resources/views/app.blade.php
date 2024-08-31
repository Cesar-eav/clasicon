<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="Clasicon - Red Social de Recomendaciones">
    <meta property="og:description"
        content="Recomienda y descubre libros, películas, juegos, series y más en Clasicon.com.">
    <meta property="og:image" content="{{ asset('storage/images/PortadaPelicula.png') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">


    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RCZ6EYBXLP"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-RCZ6EYBXLP');
    </script>
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    <title inertia>{{ config('app.name', 'K UI') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
