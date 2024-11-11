<!DOCTYPE html>
<html>
<head>
    <title>Factura</title>
    <style>
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Factura de Liquidación</h1>
    </div>

    <div class="details">
        <p><strong>Empleado:</strong> {{ $factura->user->nombre }} {{ $factura->user->apellido }}</p>
        <p><strong>DNI:</strong> {{ $factura->user->dni }}</p>
        <p><strong>Fecha:</strong> {{ $factura->created_at->format('d/m/Y') }}</p>
    </div>

    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td>Antigüedad</td>
            <td>${{ number_format($factura->resultado->antiguedad, 2) }}</td>
        </tr>
        <tr>
            <td>Presentismo</td>
            <td>${{ number_format($factura->resultado->presentismo, 2) }}</td>
        </tr>
        <!-- Agregar más filas según necesidad -->
    </table>
</body>
</html> 