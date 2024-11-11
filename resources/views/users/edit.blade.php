<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-gray-100">Editar Empleado</h1>
            
            <!-- Formulario de edición de usuario -->
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg">
                @csrf
                @method('PUT')

                <!-- Nombre -->
                <div class="flex flex-col">
                    <label for="name" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nombre</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $user->name) }}" 
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Apellido -->
                <div class="flex flex-col">
                    <label for="last_name" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Apellido</label>
                    <input 
                        type="text" 
                        name="apellido" 
                        id="apellido" 
                        value="{{ old('apellido', $user->apellido) }}" 
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    >
                    @error('last_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- DNI -->
                <div class="flex flex-col">
                    <label for="dni" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">DNI</label>
                    <input 
                        type="text"
                        name="dni"
                        id="dni"
                        value="{{ old('dni', $user->dni) }}"
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    >
                    @error('dni')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cargo (Job Title) -->
                <div class="flex flex-col">
                    <label for="job_title" class="mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cargo</label>
                    <select 
                        name="job_title_id" 
                        id="job_title" 
                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
                    >
                        <option value="">Seleccione un cargo</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}" {{ old('cargo_id', $user->cargo_id) == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('cargo_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botón de enviar -->
                <div class="flex justify-end">
                    <button 
                        type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300"
                    >
                        Editar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
