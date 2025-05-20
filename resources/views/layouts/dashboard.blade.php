<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Risk Management Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal flex">

    <!-- Sidebar -->
    <aside class="w-64 min-h-screen flex flex-col">
        <div class="p-4 text-2xl font-bold border-b border-blue-700">
            Dashboard
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-blue-700">Home</a>
            <a href="{{ route('risks.index') }}" class="block px-3 py-2 rounded hover:bg-blue-700">Risks</a>
            <a href="{{ route('risks.create') }}" class="block px-3 py-2 rounded bg-blue-700 font-semibold">Create Risk</a>
            <!-- Add more links as needed -->
        </nav>
        <div class="p-4 border-t border-blue-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded hover:bg-blue-700">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 overflow-auto">
        @yield('content')
    </main>

</body>
</html>
