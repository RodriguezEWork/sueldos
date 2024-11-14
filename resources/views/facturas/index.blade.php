<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Facturación') }}
            </h2>
            <div class="flex gap-4 items-center">
                <select id="year" name="year" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('year', date('Y')) == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>

                <select id="month" name="month" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    @foreach(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'] as $index => $mes)
                        <option value="{{ $index + 1 }}">{{ $mes }}</option>
                    @endforeach
                </select>

                <select id="user_id" name="user_id" class="select2 w-64 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Seleccione un usuario</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->nombre }} {{ $user->apellido }}</option>
                    @endforeach
                </select>

                <x-primary-button id="generateButton">
                    {{ __('Generar Factura') }}
                </x-primary-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="pdfViewer" class="w-full min-h-[600px] border dark:border-gray-700 rounded-lg">
                        <iframe id="pdfFrame" class="w-full h-full min-h-[600px]" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <script type="text/javascript">
        // Asegurarnos que el DOM está completamente cargado
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            
            // Inicializar Select2
            if($.fn.select2) {
                $('.select2').select2({
                    theme: 'classic',
                    placeholder: 'Seleccione un usuario'
                });
                console.log('Select2 initialized');
            } else {
                console.error('Select2 not loaded');
            }

            // Manejar cambio de usuario
            document.getElementById('user_id').addEventListener('change', function() {
                document.getElementById('generateButton').disabled = !this.value;
                console.log('User changed:', this.value);
            });

            // Manejar click en el botón
            document.getElementById('generateButton').addEventListener('click', async function() {
                console.log('Button clicked');
                const year = document.getElementById('year').value;
                const month = document.getElementById('month').value;
                const userId = document.getElementById('user_id').value;

                try {
                    // Mostrar algún indicador de carga
                    this.disabled = true;
                    this.textContent = 'Generando...';

                    // Generar factura
                    const generateResponse = await fetch(`{{ route('facturas.generar') }}?year=${year}&mes=${month}&user_id=${userId}`);
                    if (!generateResponse.ok) throw new Error('Error generando factura');
                    
                    // Actualizar iframe con el PDF
                    const pdfUrl = `{{ route('facturas.pdf') }}?year=${year}&mes=${month}&user_id=${userId}`;
                    document.getElementById('pdfFrame').src = pdfUrl;

                } catch (error) {
                    console.error('Error:', error);
                    alert('Hubo un error al generar la factura');
                } finally {
                    // Restaurar el botón
                    this.disabled = false;
                    this.textContent = 'Generar Factura';
                }
            });
        });
    </script>
</x-app-layout> 