<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression Preneur</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Style personnalisé pour le select2 */
        .select2-container--default .select2-selection--multiple {
            min-height: 14px;
            max-height: 100px;
            overflow-y: auto;
        }
        .select2-container {
            width: 300px !important;
        }
        #filterForm {
            margin-left: 200px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .filter-container {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        .filter-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Cache complètement les tags (texte sélectionné) */
.select2-selection__choice {
    display: none !important;
}

/* Cache l’icône de suppression (croix) */
.select2-selection__choice__remove {
    display: none !important;
}

/* Cache aussi l’icône de flèche à droite */
.select2-selection__arrow {
    display: none !important;
}

    </style>
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
    <div id="menu">
        @include('menu')
    </div>

    <div class="container" style="margin-left:200px;">
    <form method="GET" action="{{ url()->current() }}" id="filterForm" style="margin-left:380px; margin-top:75px;">
        <input type="hidden" name="start" value="{{ $start }}">
        <input type="hidden" name="end" value="{{ $end }}">

        <div class="filter-container">
            <div>
                <label for="preneursSelect" class="fw-bold">Sélectionnez les preneurs :</label><br>
                <select id="preneursSelect" name="preneurs[]" multiple>
    @foreach ($preneurs as $preneur)
        <option value="{{ $preneur->id }}"
            {{ (is_array(request('preneurs')) && in_array($preneur->id, request('preneurs'))) ? 'selected' : '' }}>
            {{ $preneur->n_matricule }} - {{ $preneur->nom }}
        </option>
    @endforeach
</select>
            </div>

            <div style="display: flex; flex-direction: column; align-items: flex-start; margin-left:100px;">
        <button type="button" id="selectAllBtn" class="btn btn-sm btn-outline-primary mt-2 mb-2">
            Tout sélectionner / Désélectionner
        </button>
        <button type="submit" class="btn btn-primary">Filtrer</button>
    </div>
        </div>
    </form> 
        <hr class="border-4">
        <span class="fw-bold fs-3">Auto hall</span> <span id="jour" style="margin-left:800px;" class="fs-3"></span>
        <hr class="border border-dark my-4">    
        <div class="text-center">
        <h4 class="border p-1 d-inline-block">ETAT DE CONSOMMATION DE CARBURANT PAR PRENEUR</h4>

        <p class="text-center">Pour la période:&nbsp;  de &nbsp; {{ $start }} &nbsp; à &nbsp; {{$end}} </p>
        <a href="/impression-site-pdf/preneur?start={{ $start }}&end={{ $end }}" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
       </a>

       <a href="/export-excel_preneur?start={{ $start }}&end={{ $end }}" class="btn btn-success text-white fw-bold" style="margin-left:800px">
        Exporter vers Excel
       </a>
       <br> <br> <br>

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
            @php
            $selectedPreneurs = request('preneurs') ?? [];
            @endphp
            
            @foreach ($bons as $codepreneur => $preneurBons)
            @if (empty($selectedPreneurs) || in_array($codepreneur, $selectedPreneurs))
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
            @endif
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
    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
       $(document).ready(function() {
    $('#preneursSelect').select2({
    placeholder: "Tapez pour rechercher",
    width: '100%',
    closeOnSelect: false,
    templateSelection: function () { return ""; }, // Pas de texte affiché
    language: {
        noResults: function() {
            return "Aucun preneur trouvé";
        }
    }
});


    $('#preneursSelect').on('select2:open', function() {
        $('.select2-search__field').val('').trigger('input');
    });

    $('#selectAllBtn').click(function() {
        let allSelected = $('#preneursSelect option').length === $('#preneursSelect').val()?.length;
        $('#preneursSelect').val(allSelected ? null : $('#preneursSelect option').map(function() {
            return $(this).val();
        }).get()).trigger('change');
    });
});
    </script>
</body>
</html>