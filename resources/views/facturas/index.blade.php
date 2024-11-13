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

                <form action="{{ route('facturas.generarTodo') }}" method="GET" class="inline">
                    <input type="hidden" name="año" value="{{ request('year', date('Y')) }}">
                    <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                    <x-primary-button type="submit">
                        {{ __('Generar Todos') }}
                    </x-primary-button>
                </form>
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
                                            <form action="{{ route('facturas.pdf') }}" method="GET" class="inline" target="_blank">
                                                <input type="hidden" name="mes" value="{{ $index + 1 }}">
                                                <input type="hidden" name="year" value="{{ request('year', date('Y')) }}">
                                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                                <x-secondary-button type="submit">
                                                    {{ __('Ver PDF') }}
                                                </x-secondary-button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('facturas.generar') }}" method="GET" class="inline">
                                            <input type="hidden" name="mes" value="{{ $index + 1 }}">
                                            <input type="hidden" name="year" value="{{ request('year', date('Y')) }}">
                                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                            <x-primary-button type="submit">
                                                {{ __('Generar') }}
                                            </x-primary-button>
                                        </form>
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
        document.getElementById('year').addEventListener('change', function() {
            window.location.href = "{{ route('facturas.index') }}?year=" + this.value + "&user_id=" + document.getElementById('user_id').value;
        });

        document.getElementById('user_id').addEventListener('change', function() {
            window.location.href = "{{ route('facturas.index') }}?year=" + document.getElementById('year').value + "&user_id=" + this.value;
        });
    </script>
    @endpush
</x-app-layout> 