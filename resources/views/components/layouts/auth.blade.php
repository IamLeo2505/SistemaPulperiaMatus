<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Iniciar Sesión</title>

        {{-- Estilos externos --}}
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://unpkg.com/heroicons@2.0.13/dist/24/outline.js" defer></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>


        {{-- Estilos propios --}}
        <style>
            body { font-family: "Century Gothic", sans-serif; }
            input:-webkit-autofill {
                box-shadow: 0 0 0px 1000px #000000 inset !important;
                -webkit-text-fill-color: white !important;
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>

    <body class="min-h-screen bg-[#151515] flex items-center justify-center">
        {{ $slot }}
        @livewireScripts
    </body>
</html>
