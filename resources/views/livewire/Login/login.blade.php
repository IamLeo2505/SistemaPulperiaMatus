<div class="bg-[#000000] shadow-xl rounded-[10px] overflow-hidden flex flex-col md:flex-row w-full md:w-[780px] md:h-[300px] mx-4">
    <div class="bg-[#3394c0] flex items-center justify-center md:w-1/3 w-full p-4">
        <img src="{{ Vite::asset('resources/img/Logo.png') }}" alt="Logo" class="w-4/5 max-h-48 md:max-h-full" />
    </div>

    <div class="login-form flex flex-col justify-center items-center text-white p-6 md:w-2/3 w-full">
        <h2 class="text-2xl font-bold mb-6">INICIO DE SESIÓN</h2>

        <input type="text" placeholder="Usuario"
                       wire:model.defer="user"
                       class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-5/6 mb-4 rounded-none" />
                @error('user') <span class="text-red-500">{{ $message }}</span> @enderror
                <div class="relative w-5/6 mb-6">
                    @if ($showPassword)
                        <input type="text" placeholder="Contraseña"
                               wire:model.defer="password"
                               class="input h-12 pr-10 bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-full rounded-none" />
                    @else
                        <input type="password" placeholder="Contraseña"
                               wire:model.defer="password"
                               class="input h-12 pr-10 bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-full rounded-none" />
                    @endif

                    @error('password') <span class="text-red-500">{{ $message }}</span> @enderror

                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <button type="button"
                                    wire:click="$toggle('showPassword')"
                                    class="text-white opacity-60 hover:opacity-100 transition duration-200">

                            @if (!$showPassword)
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-2.075 0-4.005-.676-5.542-1.823" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.27-2.944-9.544-7a9.956 9.956 0 011.419-2.645M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 3l18 18" />
                                </svg>
                            @endif
                        </button>
                    </div>
                </div>


        <button wire:click="login"
                class="btn bg-gray-600 hover:bg-[#0979b0] active:bg-[#004173] text-white w-5/6 mb-4">
            Acceder
        </button>

        <a href="{{ route('forgot-password') }}" class="text-sm text-gray-300 hover:text-[#bd552c] active:text-[#ca2f2f]">
            ¿Olvidaste tu contraseña?
        </a>
    </div>
</div>