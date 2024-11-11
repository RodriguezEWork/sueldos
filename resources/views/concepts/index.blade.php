<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Lista de Conceptos</h1>
                    <a href="{{ route('conceptos.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        + Nuevo Concepto
                    </a>
                </div>

                <!-- Tabla para listar conceptos -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-white bg-gray-800">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Concepto
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Tipo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Porcentaje
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Monto fijo
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Descripcion
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">
                                    Opciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($concepts as $concept)
                            <tr class="border-b border-gray-200">
                                <td class="py-4 px-6">{{ $concept->nombre }}</td>
                                <td class="py-4 px-6">{{ ucfirst($concept->tipo) }}</td>
                                <td class="py-4 px-6">
                                    {{ $concept->porcentaje ? $concept->porcentaje . '%' : 'N/A' }}
                                </td>
                                <td class="py-4 px-6">
                                    {{ $concept->monto_fijo ? '$' . number_format($concept->monto_fijo, 2) : 'N/A' }}
                                </td>
                                <td class="py-4 px-6">{{ $concept->descripcion }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>