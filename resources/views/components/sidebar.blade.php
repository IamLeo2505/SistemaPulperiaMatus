<aside x-data="{ open: true }"
    class="flex flex-col bg-[#004173] text-white min-h-screen transition-all duration-300"
    :class="{ 'w-64': open, 'w-20': !open }">

    <!-- Botón de Colapsar -->
    <div class="flex justify-between items-center p-4">
        <span class="text-xl font-bold" x-show="open">Menú Principal</span>
        <button @click="open = !open" class="focus:outline-none">
            <x-heroicon-o-bars-3 class="w-6 h-6" />
        </button>
    </div>

    <!-- Navegación -->
    <nav class="flex-1 space-y-1 px-2">
        @php
            $current = request()->routeIs('*') ? request()->route()->getName() : '';

            $home = [
                ['route' => 'home', 'label' => 'Home', 'icon' => 'home'],
            ];

            $sections = [
                'Servicios' => [
                    ['route' => 'facturacion', 'label' => 'Facturación', 'icon' => 'document-text'],
                    ['route' => 'compras', 'label' => 'Compras', 'icon' => 'shopping-cart'],
                    ['route' => 'inventario', 'label' => 'Inventario', 'icon' => 'archive-box'],
                ],
                'Recursos Humanos' => [
                    ['route' => 'usuarios', 'label' => 'Usuarios', 'icon' => 'users'],
                    ['route' => 'empleados', 'label' => 'Empleados', 'icon' => 'identification'],
                    ['route' => 'clientes', 'label' => 'Clientes', 'icon' => 'user'],
                    ['route' => 'proveedores', 'label' => 'Proveedores', 'icon' => 'truck'],
                ],
                'Mantenimiento' => [
                    ['route' => 'mantenimiento', 'label' => 'Copias de Seguridad', 'icon' => 'wrench-screwdriver'],
                    ['route' => 'reportes', 'label' => 'Reportes', 'icon' => 'chart-bar'],
                    ['route' => 'soporte', 'label' => 'Ayuda y soporte', 'icon' => 'question-mark-circle'],
                    ['route' => 'acercaDe', 'label' => 'Acerca de', 'icon' => 'information-circle'],
                ],
            ];
        @endphp

        <!-- Home -->
        @foreach ($home as $item)
            <a href="{{ $current !== $item['route'] ? route($item['route']) : '#' }}"
               class="flex items-center gap-4 px-4 py-3 transition-all duration-150 hover:bg-[#0979b0]
                      {{ $current === $item['route'] ? 'bg-[#0cb7f2] pointer-events-none' : '' }}">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5" />
                <span x-show="open">{{ $item['label'] }}</span>
            </a>
        @endforeach

        <!-- Secciones -->
        @foreach ($sections as $section => $items)
            <div class="mt-4">
                <span x-show="open" class="text-sm text-gray-300 font-semibold uppercase tracking-wide px-4">{{ $section }}</span>
                @foreach ($items as $item)
                    <a href="{{ $current !== $item['route'] ? route($item['route']) : '#' }}"
                       class="flex items-center gap-4 px-4 py-3 transition-all duration-150 hover:bg-[#0979b0]
                              {{ $current === $item['route'] ? 'bg-[#0cb7f2] pointer-events-none' : '' }}">
                        <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5" />
                        <span x-show="open">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        @endforeach
    </nav>
</aside>
