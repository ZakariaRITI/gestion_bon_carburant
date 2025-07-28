<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Ton Titre</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Tes fichiers CSS locaux -->
  <link rel="stylesheet" href="/css/menu.css" />
  <link rel="stylesheet" href="/css/acceuil.css" />

  <!-- Si tu as un autre fichier CSS pour ce dashboard -->
  <!-- <link rel="stylesheet" href="/css/dashboard.css" /> -->
</head>


    <div id="d1">
        <div id="menu1">
        @include('menu2')
        </div>
    </div>
    <div id="menu">
            @include('menu')
        </div>
    <div>
        <canvas id="carburantChart" width="400" height="400" style="margin-left:300px; margin-top:150px;"></canvas>
    </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('carburantChart').getContext('2d');

  const carburantChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Essence', 'Diesel'],
      datasets: [{
        label: 'Somme Totale par Type de Carburant',
        data: [{{ $result['essence'] }}, {{ $result['diesel'] }}],
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
          'rgba(54, 162, 235, 0.7)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: false,
      plugins: {
        legend: {
          position: 'bottom'
        }
      }
    }
  });
</script>
