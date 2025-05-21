<div class="p-6">
    <h4 class="text-2xl font-bold mb-6 text-black">Reportes</h4>
    <div class="grid grid-cols-5 md:grid-cols-5 gap-6">
        @foreach ($reportes as $reporte)
            <a href="{{ route('reportes.exportar', ['tipo' => $reporte['tipo']]) }}"
               class="text-black rounded-xl shadow-lg p-6 flex flex-col items-center justify-center transition transform hover:scale-105 hover:shadow-2xl text-center">
                <div class="text-5xl mb-4">{!! $reporte['icono'] !!}</div>
                <div class="text-xl font-semibold">{{ $reporte['nombre'] }}</div>
            </a>
        @endforeach
    </div>
</div>


