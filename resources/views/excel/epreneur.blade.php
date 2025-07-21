<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression Preneur</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div class="container">
        <table class="table table-bordered border-dark">
        <thead class="thead">
            <tr class="text-center">
                <th colspan="2">PRENEUR</th> 
                <th colspan="2">ESSENCE</th>
                <th colspan="2">GASOIL</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr class="text-center">
            <th>n°matricule</th>
            <th>Nom</th>
            <th>Quantité</th>
            <th>Valeur</th>
            <th>Quantité</th>
            <th>Valeur</th>
            </tr>
        </thead>
        <tbody class="tbody">
            @php
                $totalGeneralValeur = 0;
                $totalgeneralessence=0;
                $totalgeneraldiesel=0;
                $totalqessence=0;
                $totalqdiesel=0;
            @endphp 
            @foreach ($bons as $codepreneur => $preneurBons)
             @php
                $essenceQuantite = $preneurBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'essence')
                    ->sum('total_quantite');

                $essenceValeur = $preneurBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'essence')
                    ->sum('total_valeur');

                $gasoilQuantite = $preneurBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'diesel')
                    ->sum('total_quantite');

                $gasoilValeur = $preneurBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'diesel')
                    ->sum('total_valeur');

                $totalValeur = $preneurBons->sum('total_valeur');
                $totalGeneralValeur += $totalValeur;
                $totalgeneralessence += $essenceValeur;
                $totalgeneraldiesel += $gasoilValeur;
                $totalqessence+=$essenceQuantite;
                $totalqdiesel+=$gasoilQuantite;
             @endphp
            <tr class="text-center">
                <td>{{ $preneurBons->first()->n_matricule }}</td>
                <td>{{ $preneurBons->first()->nom }}</td>

                <td>{{ $essenceQuantite }}</td>
                <td>{{ number_format($essenceValeur, 2, ',', ' ') }}</td>

                <td>{{ $gasoilQuantite }}</td>
                <td>{{ number_format($gasoilValeur, 2, ',', ' ') }}</td>

                <td>{{ number_format($totalValeur, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="2" class="fs-2">Total general</td>
                <td>{{ number_format($totalqessence, 2, ',', ' ') }}</td>
                <td>{{ number_format($totalgeneralessence, 2, ',', ' ') }}</td>
                <td>{{ number_format($totalqdiesel, 2, ',', ' ') }}</td>
                <td>{{ number_format($totalgeneraldiesel, 2, ',', ' ') }}</td>
                <td>{{ number_format($totalGeneralValeur, 2, ',', ' ') }}</td>
            </tr>
        </tbody>
        </table>
</body>
</html>