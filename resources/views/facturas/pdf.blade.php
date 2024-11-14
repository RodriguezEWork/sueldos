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
        <p><strong>Fecha ingres:</strong> {{ $factura->user->fecha_ingreso->format('d/m/Y') }}</p>
    </div>

    <table>
        <tr>
            <th>Concepto</th>
            <th>Monto</th>
        </tr>
        <tr>
            <td>Bruto</td>
            <td>${{ number_format($factura->user->cargo->sueldo_base, 2) }}</td>
        </tr>
        <tr>
            <td>Antigüedad</td>
            <td>${{ number_format($factura->antiguedad, 2) }}</td>
        </tr>
        <tr>
            <td>Presentismo</td>
            <td>${{ number_format($factura->presentismo, 2) }}</td>
        </tr>
        <tr>
            <td>horas extras 50%</td>
            <td>${{ number_format($factura->horas_extras_50, 2) }}</td>
        </tr>
        <tr>
            <td>horas extras 100%</td>
            <td>${{ number_format($factura->horas_extras_100, 2) }}</td>
        </tr>
        <tr>
            <td>Vacaciones</td>
            <td>${{ number_format($factura->vacaciones, 2) }}</td>
        </tr>
        <tr>
            <td>jubilacion</td>
            <td>${{ number_format($factura->jubilacion, 2) }}</td>
        </tr>
        <tr>
            <td>ley_19032</td>
            <td>${{ number_format($factura->ley_19032, 2) }}</td>
        </tr>
        <tr>
            <td>obra_social</td>
            <td>${{ number_format($factura->obra_social, 2) }}</td>
        </tr>
        <tr>
            <td>sec_art_100</td>
            <td>${{ number_format($factura->sec_art_100, 2) }}</td>
        </tr>
        <tr>
            <td>faecys_art_100</td>
            <td>${{ number_format($factura->faecys_art_100, 2) }}</td>
        </tr>
        <tr>
            <td>sec_art_101	</td>
            <td>${{ number_format($factura->sec_art_101	, 2) }}</td>
        </tr>
        <tr>
            <td>osecac	</td>
            <td>${{ number_format($factura->osecac	, 2) }}</td>
        </tr>
        <tr>
            <td>neto	</td>
            <td>${{ number_format($factura->user->cargo->sueldo_base + 	$factura->antiguedad + $factura->presentismo + $factura->horas_extras_50 + $factura->horas_extras_100 - $factura->jubilacion - $factura->ley_19032 - $factura->obra_social - $factura->faecys_art_100 - $factura->sec_art_100 - $factura->sec_art_101 - $factura->osecac, 2) }}</td>
        </tr>
    </table>
</body>
</html> 