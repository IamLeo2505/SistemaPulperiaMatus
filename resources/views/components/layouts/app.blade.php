<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title></title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    @vite(['resources/js/app.js', 'resources/js/custom.js'])

</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    @isset($header)
        {{ $header }}
    @else
        @include('components.header')
    @endisset

    <div class="flex flex-1">
        @isset($sidebar)
            {{ $sidebar }}
        @else
            @include('components.sidebar')
        @endisset

        <main class="flex-1 p-6">
            {{ $slot }}
        </main>
    </div>

    @isset($footer)
        {{ $footer }}
    @else
        @include('components.footer')
    @endisset

    @livewireScripts
</body>
</html>