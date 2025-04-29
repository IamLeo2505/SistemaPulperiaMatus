<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        body { font-family: "Century Gothic", sans-serif; }
        input:-webkit-autofill {
            box-shadow: 0 0 0px 1000px #000000 inset !important;
            -webkit-text-fill-color: white !important;
        }
    </style>
</head>
<body class="min-h-screen bg-[#151515] flex items-center justify-center">
    <div class="bg-[#000000] shadow-xl rounded-[10px] overflow-hidden flex flex-col md:flex-row w-full md:w-[780px] md:h-[300px] mx-4">
        <div class="bg-[#3394c0] flex items-center justify-center md:w-1/3 w-full p-4">
            <img src="{{ Vite::asset('resources/img/Logo.png') }}" alt="Logo" class="w-4/5 max-h-48 md:max-h-full" />
        </div>
        <div class="login-form flex flex-col justify-center items-center text-white p-6 md:w-2/3 w-full">
            <h2 class="text-2xl font-bold mb-6">INICIO DE SESIÓN</h2>
            <input type="text" placeholder="Usuario" class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-5/6 mb-4 rounded-none" />
            <input type="password" placeholder="Contraseña" class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-5/6 mb-6 rounded-none" />
            <button class="btn bg-gray-600 hover:bg-[#0979b0] active:bg-[#004173] text-white w-5/6 mb-4">Acceder</button>
            <a href="{{ route('forgot-password') }}" class="text-sm text-gray-300 hover:text-[#bd552c] active:text-[#ca2f2f]">
                ¿Olvidaste tu contraseña?
            </a>
        </div>
</body>
</html>