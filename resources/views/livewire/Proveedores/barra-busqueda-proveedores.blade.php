<div>
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <input
            wire:model.debounce.300ms="termino"
            type="text"
            placeholder="Buscar proveedor..."
            class="input input-bordered border-[#004173] text-black rounded-full bg-white
                   w-full sm:w-64 md:w-80 lg:w-96 xl:w-[30rem]" />

        <button
            wire:click="buscar"
            class="flex items-center gap-2 bg-[#004173] text-white px-4 py-2 rounded-full hover:bg-[#00345c] transition">
            <svg xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 24 24"
                stroke-width="1.5" stroke="currentColor"
                class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <span>Buscar</span>
        </button>

        <select wire:model="filtro"
            class="select bg-white border border-[#004173] text-black rounded-full">
            <option value="nombreProveedor">Nombre</option>
            <option value="compañía">Compañía</option>
            <option value="numeroProveedor">Número</option>
        </select>
    </div>
</div>
