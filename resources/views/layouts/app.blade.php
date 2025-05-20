<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risk Management</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <header class="bg-blue-600 p-4 text-white">
        <h1 class="text-xl font-bold">Risk Management System</h1>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

    <footer class="bg-gray-200 p-4 mt-6 text-center text-gray-600">
        &copy; {{ date('Y') }} Risk Management System
    </footer>
</body>
</html>
