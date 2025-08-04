<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Véhicule</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>
    <div id="d1">
        @if(auth()->user()->type !== 'user')
        <div id="menu1">
            @include('menu2')
        </div>
        @else
        <div id="menu1">
            @include('menu3')
        </div>
        @endif
    </div>

    <div class="container" style="margin-left:200px;">
        <div id="menu">
            @include('menu')
        </div> <br><br><br><br><br>

        <h1 class="h1 text-center mb-4 fw-bold" style="color:#0f172a; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
            Recherche par n°Véhicule
        </h1>

        <div class="d-flex justify-content-center">
            <form action="" method="get" class="d-flex gap-2" style="max-width: 400px; width: 100%;">
                <input 
                    type="search" 
                    class="form-control shadow-sm border-0 rounded-3" 
                    value="{{ $motcle ?? '' }}" 
                    name="motcle" 
                    id="s" 
                    placeholder="Entrez le n° véhicule" 
                    style="padding: 12px 20px; font-size: 1.1rem;"
                >
                <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm" style="font-size: 1.1rem;">
                    Rechercher
                </button>
            </form>
        </div> <br>
        <hr class="border-4">

        @if($bons->isNotEmpty())
        <h1 class="h1 fw-bold text-center">Liste de consommation de carburant par n°véhicule</h1> <br>

        <a href="/impression-vehicule-pdf?motcle={{ $motcle }}" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
        </a>

        <a href="/export-excel_nvehicule?motcle={{ $motcle }}" class="btn btn-success text-white fw-bold" style="margin-left:800px">
            Exporter vers Excel
        </a> <br><br>

        <table class="table table-bordered table-striped professional-table">
            <thead class="table-header">
                <tr>
                    <th>n° Bon</th>
                    <th>type carburant</th>
                    <th>quantité</th>
                    <th>prix</th>
                    <th>total</th>
                    <th>date bon</th>
                    <th>date saisie</th>
                    <th>site</th>
                    <th>service</th>
                    <th>véhicule</th>
                    <th>preneur</th>
                    <th>saisi par</th>
                    @if(auth()->user()->type !== 'user')
                    <th>modifier</th>
                    <th>supprimer</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($bons as $b)
                <tr>
                    <td>{{ $b->n_bon }}</td>
                    <td>{{ $b->type_carburant }}</td>
                    <td>{{ $b->quantite }}</td>
                    <td>{{ $b->prix }}</td>
                    <td>{{ $b->total }}</td>
                    <td>{{ $b->date_bon }}</td>
                    <td>{{ $b->date_saisis }}</td>
                    <td>{{ $b->site->nom_site }}</td>
                    <td>{{ $b->service->nom_service }}</td>
                    <td>{{ $b->vehicule->n_vehicule }}</td>
                    <td>{{ $b->preneur->nom }}</td>
                    <td>{{ $b->utilisateur->name }}</td>
                    @if(auth()->user()->type !== 'user')
                    <td>
                        <a href="/update?id={{ $b->id }}" class="btn btn-edit-pro">
                            <img src="/img/modifier.png" alt="" width="15" height="15">
                        </a>
                    </td>
                    <td>
                        <a href="/delete?id={{ $b->id }}" class="btn btn-delete-pro" onclick="return confirm('Le bon sera supprimé définitivement. Veuillez confirmer la suppression.');">
                            <img src="/img/supprimer.png" alt="" width="15" height="15">
                        </a>
                    </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
        @elseif(!empty($motcle))
        <p class="text-center text-danger fw-bold">Le n° véhicule saisi n'est pas disponible.</p>
        @endif
    </div>

    <style>
        .table-header {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
        }

        .table-header th {
            background: transparent;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.3px;
            padding: 0.9rem 0.4rem;
            border: none;
            text-align: center;
        }

        .btn-edit-pro, .btn-delete-pro {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: transparent;
            border: none;
            padding: 0.4rem;
            transition: 0.3s ease;
        }

        .btn-edit-pro:hover {
            background-color: #f1c40f20;
            border-radius: 6px;
        }

        .btn-delete-pro:hover {
            background-color: #e74c3c20;
            border-radius: 6px;
        }
    </style>
</body>
</html>
