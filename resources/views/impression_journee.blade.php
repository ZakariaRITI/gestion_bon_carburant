<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression Journee</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>
<body>
    <div id="menu">
        @include('menu')
    </div> <br> <br> <br> <br> <br>

    <div class="container">
        <span class="fw-bold fs-3">Auto hall</span> <span id="jour" style="margin-left:800px;" class="fs-3"></span>
        <hr class="border border-dark my-4">    
        <div class="text-center">
        <h4 class="border p-1 d-inline-block">ETAT DE CONSOMMATION DE CARBURANT PAR JOURNEE</h4>

        <p class="text-center">Pour la période:&nbsp;  de &nbsp; {{ $start }} &nbsp; à &nbsp; {{$end}} </p>
        <a href="/impression-site-pdf/journee?start={{ $start }}&end={{ $end }}" target="_blank" class="btn btn-success float-end fw-bold">
            Télécharger / Imprimer PDF
       </a> <br> <br> 

        <table class="table table-bordered border-dark">
        <thead class="thead">
            <tr class="text-center">
                <th colspan="2">PRENEUR</th> 
                <th colspan="2">ESSENCE</th>
                <th colspan="2">GASOIL</th>
                <th rowspan="2">TOTAL</th>
            </tr>
            <tr class="text-center">
            <th>Date Bon</th>
            <th>n°Bon</th>
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
            @foreach ($bons as $codejournee => $journeeBons)
             @php
                $essenceQuantite = $journeeBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'essence')
                    ->sum('total_quantite');

                $essenceValeur = $journeeBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'essence')
                    ->sum('total_valeur');

                $gasoilQuantite = $journeeBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'diesel')
                    ->sum('total_quantite');

                $gasoilValeur = $journeeBons
                    ->filter(fn($item) => strtolower(trim($item->type_carburant)) === 'diesel')
                    ->sum('total_valeur');

                $totalValeur = $journeeBons->sum('total_valeur');
                $totalGeneralValeur += $totalValeur;
                $totalgeneralessence += $essenceValeur;
                $totalgeneraldiesel += $gasoilValeur;
                $totalqessence+=$essenceQuantite;
                $totalqdiesel+=$gasoilQuantite;
             @endphp
            <tr class="text-center">
                <td>{{ $journeeBons->first()->date_bon }}</td>
                <td>{{ $journeeBons->first()->n_bon }}</td>

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
        <span style="margin-left:700px; margin-top:200px; display: inline-block;" class="fs-4">Imprimer par:</span>
        <span style="margin-left:700px; margin-bottom:200px; display: inline-block;" class="fw-bold fs-4">{{ Auth::user()->name }}</span>
    </div>

    <script>
        const today = new Date();

        // Format jour/mois/année
        const dateFr = today.toLocaleDateString('fr-FR');
        let h = today.getHours().toString().padStart(2, '0');
        let m = today.getMinutes().toString().padStart(2, '0');
        let s = today.getSeconds().toString().padStart(2, '0');

        document.getElementById("jour").textContent="Le "+dateFr+" à "+`${h}:${m}`;
    </script>
</body>
</html>