<x-app-layout>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Crear Nuevo Concepto</h2>

                <!-- Mensajes de error -->
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('conceptos.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre del Concepto</label>
                        <input type="text" name="nombre" id="nombre" class="block w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('nombre') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Tipo de Concepto</label>
                        <select name="tipo" id="tipo" class="block w-full mt-1 p-2 border border-gray-300 rounded-md" required>
                            <option value="">Selecciona un tipo</option>
                            <option value="remunerativo" {{ old('tipo') == 'remunerativo' ? 'selected' : '' }}>Remunerativo</option>
                            <option value="no remunerativo" {{ old('tipo') == 'no_remunerativo' ? 'selected' : '' }}>No remunerativo</option>
                            <option value="aporte" {{ old('tipo') == 'aporte' ? 'selected' : '' }}>Aporte</option>
                            <option value="deduccion" {{ old('tipo') == 'deduccion' ? 'selected' : '' }}>Deduccion</option>
                        </select>
                    </div>

                    <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Porcentaje (%)</label>
                        <input type="number" name="porcentaje" id="porcentaje" step="0.01" min="0" max="100" class="block w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('porcentaje') }}">
                        <p class="text-sm text-gray-500 mt-1">Deja este campo vacío si el concepto tiene un monto fijo.</p>
                    </div>

                    <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Monto Fijo</label>
                        <input type="number" name="monto_fijo" id="monto_fijo" step="0.01" min="0" class="block w-full mt-1 p-2 border border-gray-300 rounded-md" value="{{ old('monto_fijo') }}">
                        <p class="text-sm text-gray-500 mt-1">Deja este campo vacío si el concepto tiene un porcentaje.</p>
                    </div>

                    <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Descripción</label>
                        <textarea name="descripcion" id="descripcion" class="block w-full mt-1 p-2 border border-gray-300 rounded-md">{{ old('descripcion') }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Guardar Concepto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
