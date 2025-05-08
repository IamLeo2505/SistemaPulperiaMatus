<header class="bg-white shadow px-6 py-4 flex justify-between items-center border-b-2 border-b-[#0cb7f2]">
    <h1 class="text-2xl font-semibold text-gray-800">Pulpería Matus</h1>
    @auth
        <div class="text-gray-600">{{ Auth::user()->empleado->nombre }} {{ Auth::user()->empleado->apellido }}</div>
    @endauth
    @guest
        <div class="text-gray-600">Invitado</div>
    @endguest
</header>