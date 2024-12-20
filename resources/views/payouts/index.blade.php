<!-- resources/views/payouts/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Liquidaciones') }}
            </h2>
            <div class="flex items-center gap-4">
                <select id="year" name="year" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('year', date('Y')) == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Mes
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Faltas Injustificadas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Faltas Justificadas
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Vacaciones
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Horas Extras 50%
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Horas Extras 100%
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                @foreach($facturas as $factura)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $factura->mes }} / {{ $factura->año }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $factura->injustificadas ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $factura->justificadas ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $factura->vacaciones_nro ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $factura->horas_extras_50_nro ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $factura->horas_extras_100_nro ?? 0 }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <a href="{{ route('facturas.pdf', ['user_id' => $factura->user_id, 'mes' => $factura->mes, 'year' => $factura->año]) }}" target="_blank">
                                                <x-primary-button id="generateButton">
                                                    Ver factura
                                                </x-primary-button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.getElementById('year').addEventListener('change', function() {
        });
    </script>
    @endpush
</x-app-layout>
