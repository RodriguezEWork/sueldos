<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                    <!-- Botón para Ver Empleados -->
                    <a href="{{ route('empleados') }}" class="block p-6 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-lg flex flex-col items-center">
                        <svg class="w-12 h-12 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A6.5 6.5 0 1117.804 5.121m0 0A6.5 6.5 0 0112 20m0 0h.01" />
                        </svg>
                        <span class="text-lg font-semibold">Ver Empleados</span>
                    </a>

                    <!-- Botón para Gestionar Liquidaciones -->
                    <a href="{{ route('empleados') }}" class="block p-6 bg-green-500 hover:bg-green-600 text-white rounded-lg shadow-lg flex flex-col items-center">
                        <svg class="w-12 h-12 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m-4-4h8" />
                        </svg>
                        <span class="text-lg font-semibold">Gestionar Liquidaciones</span>
                    </a>

                    <!-- Botón para Reportes -->
                    <a href="{{ route('empleados') }}" class="block p-6 bg-red-500 hover:bg-red-600 text-white rounded-lg shadow-lg flex flex-col items-center">
                        <svg class="w-12 h-12 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-lg font-semibold">Reportes</span>
                    </a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
