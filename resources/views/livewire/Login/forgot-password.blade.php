        <div class="bg-[#000000] shadow-xl rounded-[10px] overflow-hidden flex flex-col md:flex-row w-full md:w-[780px] md:h-[300px] mx-4">
            <div class="bg-[#3394c0] flex items-center justify-center md:w-1/3 w-full p-4">
                <img src="{{ Vite::asset('resources/img/Logo.png') }}"
                     alt="Logo"
                     class="w-4/5 max-h-48 md:max-h-full" />
            </div>

            <div class="login-form flex flex-col justify-center items-center text-white p-6 md:w-2/3 w-full">
                <h2 class="text-2xl font-bold mb-6 text-center">RECUPERAR CONTRASEÑA</h2>
                <form id="resetPasswordForm" class="w-full flex flex-col items-center">
                    <div class="flex flex-col md:flex-row gap-6 w-full mb-6">
                        <div class="flex flex-col gap-4 w-full">
                            <input type="correo"
                                   placeholder="Ingrese su correo electrónico"
                                   id="correo"
                                   autocomplete="off"
                                   class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-full mb-2 rounded-none"
                                   required />
                        </div>
                        <div class="flex flex-col gap-4 w-full">
                            <input type="password"
                                   placeholder="Ingrese su nueva contraseña"
                                   id="nueva-pass"
                                   autocomplete="off"
                                   class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-full mb-2 rounded-none"
                                   required />
                            <input type="password"
                                   placeholder="Confirmar nueva contraseña"
                                   id="confirm-pass"
                                   autocomplete="off"
                                   class="input bg-transparent border-b-2 border-t-0 border-l-0 border-r-0 border-gray-500 focus:border-[#0cb7f2] focus:outline-none text-white w-full mb-2 rounded-none"
                                   required />
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 w-full">
                        <button
                            type="button"
                            onclick="window.location.href='/recover-password'"
                            class="btn bg-gray-600 hover:bg-[#0979b0] active:bg-[#004173] text-white flex-1">
                            ENVIAR CÓDIGO
                        </button>

                        <button
                            type="button"
                            onclick="window.location.href='/login'"
                            class="btn bg-gray-600 hover:bg-[#bd552c] active:bg-[#ca2f2f] text-white flex-1">
                            CANCELAR
                        </button>
                    </div>
                </form>
            </div>
        </div>
