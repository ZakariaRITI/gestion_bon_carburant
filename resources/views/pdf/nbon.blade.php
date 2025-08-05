<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Rechercher Bon</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            margin: 10px;
            color: #000;
        }
        .fw-bold { font-weight: bold; }
        .fs-3 { font-size: 1.2rem; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .my-4 { margin: 1rem 0; }
        table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
            margin-top: 1rem;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 2px 4px;
            word-wrap: break-word;
            text-align: center;
        }
        td:nth-child(1), td:nth-child(2) {
            white-space: nowrap;
        }
        thead tr {
            background-color: #eee;
        }
    </style>
</head>
<body>

<div>
    <span class="fw-bold fs-3">Auto hall</span>
    <span class="text-right fs-3" style="float:right;">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</span>

    <hr class="my-4">

    @if($bons->isNotEmpty())
        <div class="text-center">
            <h4 class="fw-bold fs-3">Rapport de consommation de carburant</h4>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 6%;">n° Bon</th>
                    <th style="width: 7%;">Type</th>
                    <th style="width: 5%;">Qté</th>
                    <th style="width: 5%;">Prix</th>
                    <th style="width: 6%;">Total</th>
                    <th style="width: 9%;">Date Bon</th>
                    <th style="width: 9%;">Date Saisie</th>
                    <th style="width: 9%;">Site</th>
                    <th style="width: 9%;">Service</th>
                    <th style="width: 8%;">Véhicule</th>
                    <th style="width: 12%;">Preneur</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($bons as $b)
                <tr>
                    <td>{{ $b->n_bon }}</td>
                    <td>{{ $b->type_carburant }}</td>
                    <td>{{ number_format($b->quantite, 2, ',', '') }}</td>
                    <td>{{ number_format($b->prix, 2, ',', '') }}</td>
                    <td>{{ number_format($b->total, 2, ',', '') }}</td>
                    <td>{{ $b->date_bon }}</td>
                    <td>{{ $b->date_saisis }}</td>
                    <td>{{ $b->site->nom_site ?? '' }}</td>
                    <td>{{ $b->service->nom_service ?? '' }}</td>
                    <td>{{ $b->vehicule->n_vehicule ?? '' }}</td>
                    <td>{{ $b->preneur->nom ?? '' }}</td>
                    <
                </tr>
                @endforeach
            </tbody>
        </table>
    @elseif(!empty($motcle))
        <p class="text-center text-danger fw-bold my-4">Le N°Bon saisi n'est pas disponible</p>
    @endif

    <div style="margin-top: 300px;" class="text-right fw-bold fs-3">
        Imprimé par : {{ Auth::user()->name }}
    </div>
</div>

</body>
</html>
