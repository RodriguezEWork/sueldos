<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">Liquidación #{{ $payout->id }}</h1>
                <p><strong>Empleado:</strong> {{ $payout->user->name }} {{ $payout->user->last_name }}</p>
                <p><strong>Fecha de Liquidación:</strong> {{ $payout->payout_date->format('d/m/Y') }}</p>

                <h2 class="text-xl font-semibold mt-6 mb-4">Conceptos Aplicados</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Concepto</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Monto Aplicado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payout->concepts as $concept)
                            <tr>
                                <td class="border border-gray-300 px-4 py-2">{{ $concept->nombre }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ number_format($concept->pivot->monto_aplicado, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 font-bold">Total</td>
                            <td class="border border-gray-300 px-4 py-2 font-bold">
                                {{ number_format($payout->concepts->sum(function ($concept) {
                                    return $concept->pivot->monto_aplicado;
                                }), 2) }}
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <div class="mt-6">
                    <a href="{{ route('payouts.index') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Volver a la lista de liquidaciones
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
