<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Facturación') }}
            </h2>
            <div class="flex gap-4">
                <select id="year" name="year" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('year', date('Y')) == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>

                <select id="user_id" name="user_id" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Todos los usuarios</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nombre }} {{ $user->apellido }}</option>
                    @endforeach
                </select>

                <x-primary-button onclick="generarTodo()">
                    {{ __('Generar Todos') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 gap-6">
                        @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                            <div class="border dark:border-gray-700 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold">{{ $mes }}</h3>
                                    <div class="flex gap-2">
                                        @if(isset($facturas[$index + 1]))
                                            <button 
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                                onclick="window.open('{{ route('facturas.pdf', ['mes' => $index + 1, 'año' => request('year', date('Y')), 'user_id' => request('user_id')]) }}', '_blank')"
                                            >
                                                {{ __('Ver PDF') }}
                                            </button>
                                        @endif
                                        <button 
                                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                                            onclick="generarFactura({{ $index + 1 }})"
                                        >
                                            {{ __('Generar') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function generarFactura(mes) {
            const year = document.getElementById('year').value;
            const userId = document.getElementById('user_id').value;
            
            window.location.href = `{{ route('facturas.generar') }}?mes=${mes}&año=${year}&user_id=${userId}`;
        }

        function generarTodo() {
            const year = document.getElementById('year').value;
            const userId = document.getElementById('user_id').value;
            
            window.location.href = `{{ route('facturas.generarTodo') }}?año=${year}&user_id=${userId}`;
        }

        document.getElementById('year').addEventListener('change', function() {
            window.location.href = "{{ route('facturas.index') }}?year=" + this.value + "&user_id=" + document.getElementById('user_id').value;
        });

        document.getElementById('user_id').addEventListener('change', function() {
            window.location.href = "{{ route('facturas.index') }}?year=" + document.getElementById('year').value + "&user_id=" + this.value;
        });
    </script>
    @endpush
</x-app-layout> 