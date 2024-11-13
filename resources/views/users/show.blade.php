<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Detalles del Empleado</h1>

                <!-- Información del empleado -->
                <div class="bg-white dark:bg-gray-900 rounded-lg p-6 shadow-lg">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <!-- DNI -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">DNI</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->dni }}</p>
                        </div>

                        <!-- Cargo -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Cargo</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->cargo->nombre }}</p>
                        </div>

                        <!-- Nombre -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Nombre</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                        </div>

                        <!-- Apellido -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Apellido</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->apellido }}</p>
                        </div>

                        <!-- Correo Electrónico -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Correo Electrónico</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->email }}</p>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Dirección</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->direccion }}</p>
                        </div>

                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Fecha de Nacimiento</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->fecha_nacimiento->format('d/m/Y') }}</p>
                        </div>

                        <!-- Fecha de Creación -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Fecha de Ingreso</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->fecha_ingreso->format('d/m/Y') }}</p>
                        </div>
                        <!-- Salario Base -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Salario Base</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">${{ number_format($user->cargo->sueldo_base, 2) }}</p>
                        </div>

                        <!-- Última Actualización -->
                        <div>
                            <h2 class="text-sm font-semibold text-gray-500 dark:text-gray-400 uppercase">Última Actualización</h2>
                            <p class="text-lg font-medium text-gray-900 dark:text-gray-100">{{ $user->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex mt-8 space-x-4">
                    <a href="{{ route('users.edit', $user->id) }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Editar Empleado
                    </a>
                    <a href="{{ route('liquidaciones.index', $user->id) }}" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                        Ver Liquidaciones
                    </a>
                    <a href="{{ route('empleados') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                        Volver a la Lista de Empleados
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>