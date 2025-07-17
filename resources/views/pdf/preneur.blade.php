<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Impression Preneur</title>
    <style>
        /* Reset et base */
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 13px;
            margin: 20px;
            color: #000;
        }
        /* Titres */
        .fw-bold { font-weight: 700; }
        .fs-3 { font-size: 1.75rem; }
        .fs-4 { font-size: 1.5rem; }
        .fs-2 { font-size: 1.75rem; }
        /* Bordures */
        .border {
            border: 1px solid #000;
        }
        .border-dark {
            border-color: #000;
        }
        /* Marges */
        .my-4 {
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
        /* Padding */
        .p-1 {
            padding: 0.25rem;
        }
        /* Textes */
        .text-center {
            text-align: center;
        }
        /* Tableau */
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: center;
        }
        thead tr {
            background-color: #eee;
        }
        /* Conteneurs */
        .container {
            width: 100%;
        }
        /* Positionnements */
        .float-right {
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <span class="fw-bold fs-3">Auto hall</span>
        <span class="float-right fs-3">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>

        <hr class="border border-dark my-4">

        <div class="text-center">
            <h4 class="border p-1 d-inline-block">ETAT RECAPITULATIF PAR PRENEUR</h4>
            <p>Pour la période : du {{ $start }} au {{ $end }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th colspan="2">PRENEUR</th>
                    <th colspan="2">ESSENCE</th>
                    <th colspan="2">GASOIL</th>
                    <th rowspan="2">TOTAL</th>
                </tr>
                <tr>
                    <th>n° matricule</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Valeur</th>
                    <th>Quantité</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalGeneralValeur = 0;
                    $totalgeneralessence = 0;
                    $totalgeneraldiesel = 0;
                    $totalqessence = 0;
                    $totalqdiesel = 0;
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
                        $totalqessence += $essenceQuantite;
                        $totalqdiesel += $gasoilQuantite;
                    @endphp
                    <tr>
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
                    <td colspan="2" class="fs-2 fw-bold">Total général</td>
                    <td>{{ number_format($totalqessence, 2, ',', ' ') }}</td>
                    <td>{{ number_format($totalgeneralessence, 2, ',', ' ') }}</td>
                    <td>{{ number_format($totalqdiesel, 2, ',', ' ') }}</td>
                    <td>{{ number_format($totalgeneraldiesel, 2, ',', ' ') }}</td>
                    <td>{{ number_format($totalGeneralValeur, 2, ',', ' ') }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 150px; text-align: right; font-weight: bold; font-size: 1.25rem;">
            Imprimé par : {{ Auth::user()->name }}
        </div>
    </div>

</body>
</html>
