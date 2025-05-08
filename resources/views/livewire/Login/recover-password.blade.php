<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Restablecer contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
      body {
        font-family: 'Century Gothic', sans-serif;
      }
      input[type="number"]::-webkit-outer-spin-button,
      input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      input[type="number"]:focus {
        border-color: #0cb7f2;
      }
    </style>
  </head>
  <body class="bg-[#151515] min-h-screen flex items-center justify-center">
    <div class="bg-black shadow-xl rounded-[10px] overflow-hidden flex flex-col md:flex-row w-full md:w-[780px] mx-4">
      
      <!-- Panel logo -->
      <div class="bg-[#3394c0] flex items-center justify-center md:w-1/3 w-full h-[150px] md:h-auto p-4">
        <img src="{{ Vite::asset('resources/img/Logo.png') }}" alt="Logo" class="w-4/5 max-h-48 md:max-h-full" />
      </div>

      <!-- Panel formulario -->
      <div class="flex flex-col justify-center items-center text-white p-6 md:w-2/3 w-full">
        <h1 class="text-2xl font-bold mb-4 text-center">REESTABLECER CONTRASEÑA</h1>
        <p class="text-sm mb-4 text-center">
          Se ha enviado el código de verificación al correo electrónico previamente registrado con su usuario.<br />
          Por favor, ingrese el código antes de que expire <span class="text-[#0cb7f2] font-bold">00:00</span>
        </p>

        <form class="w-full flex flex-col items-center">
          <!-- Inputs de código -->
          <div class="flex justify-center gap-2 mb-4">
            <input type="number" maxlength="1" id="digit1" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
            <input type="number" maxlength="1" id="digit2" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
            <input type="number" maxlength="1" id="digit3" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
            <input type="number" maxlength="1" id="digit4" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
            <input type="number" maxlength="1" id="digit5" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
            <input type="number" maxlength="1" id="digit6" class="code-input w-10 h-12 text-center text-xl border border-gray-300 rounded bg-gray-50 text-black" required />
          </div>

          <div class="mb-4 text-center text-sm">
            <a href="#" class="text-[#0cb7f2] hover:underline hover:text-[#0979b0]">¿No has recibido el código de verificación?</a>
          </div>

          <!-- Botones -->
          <div class="flex flex-col md:flex-row gap-4 w-full items-center">
            <button type="submit" class="w-5/6 md:w-5/6 bg-[#0cb7f2] text-white font-bold py-2 rounded shadow hover:bg-[#0979b0] active:bg-[#004173] animate-pulse">
              REESTABLECER CONTRASEÑA
            </button>
            <button type="button" onclick="window.location.href='/'" class="w-5/6 md:w-5/6 bg-gray-600 text-white font-bold py-2 rounded shadow hover:bg-gray-700">
              CANCELAR
            </button>
          </div>
        </form>
      </div>
    </div>
    @livewireScripts
    <script>
        const codeInputs = document.querySelectorAll('.code-input');

        codeInputs.forEach((input, index) => {
            input.addEventListener('input', () => {
                const value = input.value;
                if (value.length > 1) {
                    input.value = value.slice(0, 1);
                }
                if (value.length === 1 && index < codeInputs.length - 1) {
                    codeInputs[index + 1].focus();
                }
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Backspace' && input.value.length === 0 && index > 0) {
                    codeInputs[index - 1].focus();
                }
            });
        });

        // Enfocar el primer input al cargar la página
        window.onload = () => {
            if (codeInputs.length > 0) {
                codeInputs[0].focus();
            }
        };
    </script>
  </body>
</html>
