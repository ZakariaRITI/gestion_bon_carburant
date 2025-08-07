<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Impression Journée</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    .select2-selection__choice__remove {
        display: none !important;
    }
    .select2-selection__choice {
        display: none !important;
    }
  </style>
</head>
<body>

<div id="d1">
    @if(auth()->user()->type !== 'user')
      <div id="menu1">@include('menu2')</div>
    @else
      <div id="menu1">@include('menu3')</div>
    @endif
</div>

<div id="menu">@include('menu')</div>

<div class="container" style="margin-left:200px;">
  {{-- Filtres --}}
  <form method="GET" action="{{ url()->current() }}" id="filterForm" style="margin-left:400px; margin-top:120px;">
    <input type="hidden" name="start" value="{{ $start }}">
    <input type="hidden" name="end" value="{{ $end }}">

    <label for="joursSelect" class="fw-bold">Sélectionnez les journées :</label><br>

    <select id="joursSelect" name="jours[]" multiple>
      @foreach ($bons->keys() as $jour)
        <option value="{{ $jour }}" {{ (is_array(request('jours')) && in_array($jour, request('jours'))) ? 'selected' : '' }}>
          {{ $jour }}
        </option>
      @endforeach
    </select>

    <div style="display: flex; flex-direction: column; margin-top: -100px; align-items: flex-start; margin-left:400px;">
      <button type="button" id="selectAllBtn" class="btn btn-sm btn-outline-primary mt-2 mb-2">Tout sélectionner / Désélectionner</button>
      <button type="submit" class="btn btn-primary">Filtrer</button>
    </div>
  </form>

  <br>
  <hr class="border-4">
  <span class="fw-bold fs-3">Auto hall</span> 
  <span id="jour" style="margin-left:800px;" class="fs-3"></span>
  <hr class="border border-dark my-4">

  <div class="text-center">
    <h4 class="border p-1 d-inline-block">ETAT DE CONSOMMATION DE CARBURANT PAR JOURNEE</h4>
    <p class="text-center">Pour la période: de {{ $start }} à {{ $end }}</p>

    <a href="/impression-site-pdf/journee?start={{ $start }}&end={{ $end }}" target="_blank" class="btn btn-danger float-end fw-bold">
      Télécharger / Imprimer PDF
    </a>

    <a href="/export-excel_journee?start={{ $start }}&end={{ $end }}" class="btn btn-success text-white fw-bold" style="margin-left:800px">
      Exporter vers Excel
    </a>
    <br><br><br>

    <table class="table table-bordered border-dark">
      <thead class="thead">
        <tr class="text-center">
          <th colspan="2">BON</th>
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
          $selectedJours = request('jours') ?? [];
        @endphp

        @foreach ($bons as $date => $journeeBons)
          @if (empty($selectedJours) || in_array($date, $selectedJours))
            @php
              $essenceQuantite = $journeeBons->where('type_carburant', 'essence')->sum('total_quantite');
              $essenceValeur = $journeeBons->where('type_carburant', 'essence')->sum('total_valeur');

              $gasoilQuantite = $journeeBons->where('type_carburant', 'diesel')->sum('total_quantite');
              $gasoilValeur = $journeeBons->where('type_carburant', 'diesel')->sum('total_valeur');

              $totalValeur = $journeeBons->sum('total_valeur');

              $totalGeneralValeur += $totalValeur;
              $totalgeneralessence += $essenceValeur;
              $totalgeneraldiesel += $gasoilValeur;
              $totalqessence += $essenceQuantite;
              $totalqdiesel += $gasoilQuantite;
            @endphp

            <tr class="text-center">
              <td>{{ $date }}</td>
              <td>{{ $journeeBons->first()->n_bon }}</td>
              <td>{{ $essenceQuantite }}</td>
              <td>{{ number_format($essenceValeur, 2, ',', ' ') }}</td>
              <td>{{ $gasoilQuantite }}</td>
              <td>{{ number_format($gasoilValeur, 2, ',', ' ') }}</td>
              <td>{{ number_format($totalValeur, 2, ',', ' ') }}</td>
            </tr>
          @endif
        @endforeach

        <tr>
          <td colspan="2" class="fs-2">Total général</td>
          <td>{{ number_format($totalqessence, 2, ',', ' ') }}</td>
          <td>{{ number_format($totalgeneralessence, 2, ',', ' ') }}</td>
          <td>{{ number_format($totalqdiesel, 2, ',', ' ') }}</td>
          <td>{{ number_format($totalgeneraldiesel, 2, ',', ' ') }}</td>
          <td>{{ number_format($totalGeneralValeur, 2, ',', ' ') }}</td>
        </tr>
      </tbody>
    </table>

    <span style="margin-left:700px; margin-top:200px; display: inline-block;" class="fs-4">Imprimé par :</span>
    <span style="margin-left:700px; margin-bottom:200px; display: inline-block;" class="fw-bold fs-4">{{ Auth::user()->name }}</span>
  </div>
</div>

<script>
  const today = new Date();
  const dateFr = today.toLocaleDateString('fr-FR');
  let h = today.getHours().toString().padStart(2, '0');
  let m = today.getMinutes().toString().padStart(2, '0');
  document.getElementById("jour").textContent = "Le " + dateFr + " à " + `${h}:${m}`;
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function () {
    $('#joursSelect').select2({
      placeholder: "Tapez une date",
      width: '300px',
      closeOnSelect: false,
      templateSelection: function () { return ""; }
    });

    $('#selectAllBtn').click(function () {
      let allSelected = $('#joursSelect option').length === $('#joursSelect').val()?.length;
      if (allSelected) {
        $('#joursSelect').val(null).trigger('change');
      } else {
        let allValues = [];
        $('#joursSelect option').each(function () {
          allValues.push($(this).val());
        });
        $('#joursSelect').val(allValues).trigger('change');
      }
    });
  });
</script>

</body>
</html>
