<div>
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <!-- Campo de texto de búsqueda -->
        <div class="relative flex items-center overflow-hidden w-[32rem] h-[42px] border-2 border-[#004173] rounded-full">
            <button
                wire:click="buscar"
                class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-600 bg-transparent focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
            </button>

            <input
                wire:model.debounce.300ms="termino"
                type="text"
                placeholder="Buscar venta..."
                class="w-full h-full px-12 text-black bg-transparent focus:outline-none rounded-full" />

            <button
                onclick="location.reload()"
                class="absolute inset-y-0 right-[6rem] flex items-center pr-3 text-gray-400 bg-transparent focus:outline-none z-20 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <button
                wire:click="buscar"
                class="absolute inset-y-0 right-0 flex items-center px-4 text-white bg-[#004173] rounded-r-full h-full hover:bg-[#00345c] transition focus:outline-none text-sm z-20">
                <svg xmlns="http://www.w3.org/2000/svg"
                     fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor"
                     class="w-5 h-5 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <span>Buscar</span>
            </button>
        </div>

        <!-- Select de filtros -->
        <div class="flex items-center border border-[#004173] bg-gray-200 rounded-full px-3 h-[42px] w-[12rem]">
            <svg xmlns="http://www.w3.org/2000/svg"
                 fill="none" viewBox="0 0 24 24"
                 stroke-width="1.5" stroke="currentColor"
                 class="w-8 h-8 text-[#004173] mr-2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
            </svg>

            <select
                wire:model="filtro"
                class="select bg-transparent border-none text-black focus:outline-none text-sm w-full">
                <option value="nventa">N° Venta</option>
                <option value="fecha">Fecha</option>
                <option value="cliente">Cliente</option>
            </select>
        </div>
    </div>
</div>