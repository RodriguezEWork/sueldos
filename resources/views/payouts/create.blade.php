<x-app-layout>
    <div class="py-12">
        <div class="w-1/2 mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-6 bg-gray-800 shadow sm:rounded-lg">
                <h1 class="text-2xl font-bold mb-6 text-white">Realizar Liquidación para {{ $user->name }} {{ $user->last_name }}</h1>

                <!-- Mostrar los detalles del empleado -->
                <div class="bg-gray-700 shadow-md rounded p-4 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-white">Detalles del Empleado</h2>
                    <p class="text-gray-300"><strong>DNI:</strong> {{ $user->dni }}</p>
                    <p class="text-gray-300"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="text-gray-300"><strong>Puesto:</strong> {{ $user->jobTitle->name }}</p>
                    <p class="text-gray-300"><strong>Salario Base:</strong> ${{ number_format($user->jobTitle->base_salary, 2) }}</p>
                </div>

                <!-- Mostrar los conceptos aplicados -->
                <div class="bg-gray-700 shadow-md rounded p-4 mb-6">
                    <h2 class="text-xl font-semibold mb-4 text-white">Conceptos Aplicados</h2>
                    <ul class="text-gray-300">
                        @foreach($concepts as $concept)
                        <li>
                            {{ $concept->nombre }} ({{$concept->porcentaje ? $concept->porcentaje . '%' : '$' . number_format($concept->monto_fijo, 2)}})
                            <input type="hidden" name="concepts[{{ $loop->index }}][id]" value="{{ $concept->id }}">
                        </li>
                        @endforeach
                    </ul>
                </div>



                <!-- Resumen del cálculo final -->
                <div class="bg-gray-700 shadow-md rounded p-6">
                    <h2 class="text-xl font-semibold mb-4 text-white">Resumen de Liquidación</h2>
                    <p class="text-gray-300"><strong>Salario Final:</strong> ${{ number_format($netSalary ?? 0, 2) }}</p>

                    <!-- Formulario para confirmar la liquidación -->
                    <form action="{{ route('liquidaciones.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <input type="hidden" name="payout_date" value="{{ date('Y-m-d') }}">

                        <!-- Añadir sección para seleccionar conceptos -->
                        <div class="mb-4">
                            <label for="concepts" class="block text-sm font-medium text-gray-700">Conceptos</label>
                            @foreach($concepts as $concept)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" name="concepts[{{ $concept->id }}][id]" value="{{ $concept->id }}" id="concept-{{ $concept->id }}">
                                <label for="concept-{{ $concept->id }}" class="ml-2">{{ $concept->name }} ({{ $concept->tipo }})</label>
                                <input type="number" name="concepts[{{ $concept->id }}][monto_aplicado]" placeholder="Monto" class="ml-2 w-32" min="0" step="0.01" required>
                            </div>
                            @endforeach
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Realizar Liquidación
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>