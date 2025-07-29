<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="/css/acceuil.css">
  <link rel="stylesheet" href="/css/menu.css">

  <style>
    body {
      background-color: #f8f9fa;
      overflow-x: hidden;
      overflow-y: hidden; /* plus de scroll vertical */
    }
    .main-content {
      margin-left: 220px;
      padding: 30px 20px 10px; /* réduit le padding-top */
    }
    .card-stat {
      min-height: 80px; /* réduit la hauteur des cards */
    }
    .chart-container {
      background: white;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 8px rgba(0,0,0,0.05);
      height: 250px;       /* réduit la hauteur des 2 premiers graphiques */
    }
    .chart-container.small {
      height: 200px;       /* réduit la hauteur du 3ème graphique */
    }
    canvas {
      width: 100% !important;
      height: 100% !important;
    }
  </style>
</head>

<body>
  <div id="menu1">@include('menu2')</div>
  <div id="menu">@include('menu')</div>

  <div class="main-content">
    <!-- Cards -->
    <div class="row mb-3" style="margin-top:80px">
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Sites</h6>
            <p class="card-text fs-5 mb-0">{{ $sites }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Services</h6>
            <p class="card-text fs-5 mb-0">{{ $services }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Véhicules</h6>
            <p class="card-text fs-5 mb-0">{{ $vehicules }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Preneurs</h6>
            <p class="card-text fs-5 mb-0">{{ $preneurs }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Utilisateurs</h6>
            <p class="card-text fs-5 mb-0">{{ $users }}</p>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card text-dark bg-light card-stat">
          <div class="card-body text-center py-2">
            <h6 class="card-title mb-1">Bons</h6>
            <p class="card-text fs-5 mb-0">{{ $bons }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Charts -->
    <div class="row mb-3">
      <div class="col-md-6">
        <div class="chart-container">
          <canvas id="chart3"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="chart-container">
          <canvas id="chart2"></canvas>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="chart-container small">
          <canvas id="chart1"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Chart 1: Véhicules par marque (large en bas)
    new Chart(document.getElementById('chart1'), {
      type: 'bar',
      data: {
        labels: {!! json_encode($vehi1->pluck('marque')) !!},
        datasets: [{ 
          // label retiré pour éviter redondance avec title
          data: {!! json_encode($vehi1->pluck('total')) !!},
          backgroundColor: ['#2C3E50','#18BC9C','#3498DB','#9B59B6','#E67E22','#95A5A6','#34495E']
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: { y: { beginAtZero: true } },
        plugins: { 
          legend: { display: false },
          title: {
            display: true,
            text: 'Nombre de véhicules par marque',
            font: { size: 18 },
            padding: { bottom: 10 }
          }
        }
      }
    });

    // Chart 2: Répartition des carburants (milieu à droite)
    new Chart(document.getElementById('chart2'), {
      type: 'pie',
      data: {
        labels: {!! json_encode($carburant->pluck('carburant')) !!},
        datasets: [{
          // label retiré pour éviter redondance avec title
          data: {!! json_encode($carburant->pluck('somme_total')) !!},
          backgroundColor: [
            '#4e73df', // Bleu
            '#1cc88a', // Vert
            '#36b9cc', // Cyan
            '#f6c23e', // Jaune
            '#e74a3b', // Rouge
            '#858796'  // Gris
          ]
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' },
          title: {
            display: true,
            text: 'Répartition des carburants (somme totale)',
            font: { size: 18 },
            padding: { top: 10, bottom: 10 }
          }
        }
      }
    });

    // Chart 3 : Nombre de bons par année (ligne)
new Chart(document.getElementById('chart3'), {
  type: 'line',  // <-- ici on change 'bar' en 'line'
  data: {
    labels: {!! json_encode($bonsParAnnee->pluck('annee')) !!},
    datasets: [{
      // label retiré pour éviter redondance avec title
      data: {!! json_encode($bonsParAnnee->pluck('total')) !!},
      backgroundColor: 'rgba(78, 115, 223, 0.2)', // bleu clair transparent pour remplissage
      borderColor: '#4e73df', // bleu plus foncé pour ligne
      borderWidth: 2,
      fill: true,
      tension: 0.3, // courbure de la ligne, 0 = droite, plus grand = plus arrondi
      pointRadius: 4,
      pointBackgroundColor: '#4e73df'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
      y: { beginAtZero: true, ticks: { stepSize: 1 } }
    },
    plugins: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Nombre de bons par année',
        font: { size: 18 },
        padding: { bottom: 10 }
      }
    }
  }
});

  </script>
</body>
</html>
