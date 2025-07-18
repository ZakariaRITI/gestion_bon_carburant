<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Rechercher Bon</title>
    <style>
    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 12px;
        color: #000;
        margin: 20px;
    }
    .fw-bold { font-weight: bold; }
    .fs-3 { font-size: 1.75rem; }
    .fs-4 { font-size: 1.25rem; }
    .fs-2 { font-size: 1.5rem; }
    .text-center { text-align: center; }
    .border-dark { border-color: #000 !important; }
    .my-4 { margin-top: 1.5rem; margin-bottom: 1.5rem; }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        table-layout: fixed;
    }
    th, td {
        border: 1px solid #000;
        padding: 4px 6px;
        text-align: center;
        font-size: 10px;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }
    thead {
        background-color: #ccc;
    }
</style>

</head>
<body>

    <div class="container">
        <span class="fw-bold fs-3">Auto Hall</span>
        <span style="float: right;" class="fs-3">
            Le {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}
        </span>

        <hr class="border border-dark my-4" />

        @if($bons->isNotEmpty())
            <h2 class="text-center my-4 fw-bold">Détail des consommations carburant</h2>

            <table>
                <thead>
                    <tr>
                        <th>n° Bon</th>
                        <th>Type carburant</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Date Bon</th>
                        <th>Date Saisie</th>
                        <th>Site</th>
                        <th>Service</th>
                        <th>n° Véhicule</th>
                        <th>Nom Preneur</th>
                        <th>Saisi par</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bons as $b)
                    <tr>
                        <td>{{ $b->n_bon }}</td>
                        <td>{{ $b->type_carburant }}</td>
                        <td>{{ $b->quantite }}</td>
                        <td>{{ number_format($b->prix, 2, ',', ' ') }}</td>
                        <td>{{ number_format($b->total, 2, ',', ' ') }}</td>
                        <td>{{ $b->date_bon }}</td>
                        <td>{{ $b->date_saisis }}</td>
                        <td>{{ $b->site->nom_site ?? '' }}</td>
                        <td>{{ $b->service->nom_service ?? '' }}</td>
                        <td>{{ $b->vehicule->n_vehicule ?? '' }}</td>
                        <td>{{ $b->preneur->nom ?? '' }}</td>
                        <td>{{ $b->utilisateur->name ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @elseif(!empty($motcle))
            <p class="text-center text-danger fw-bold mt-4">Le N°Bon saisi n'est pas disponible</p>
        @endif

        <div style="text-align: right; margin-top: 200px;" class="fs-4">
            Imprimé par : <br><span class="fw-bold">{{ Auth::user()->name }}</span>
        </div>
    </div>

</body>
</html>
