<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>App</title>

    {{-- Vite Tailwind --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Livewire styles --}}
    @livewireStyles
</head>

<body class="h-screen flex items-center justify-center bg-gray-100">

    @yield('body')

    {{-- Livewire scripts --}}
    @livewireScripts

</body>
</html>