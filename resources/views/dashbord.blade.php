<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="/css/acceuil.css">
  <link rel="stylesheet" href="/css/menu.css">
  <style>
    body 
    {
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }
    
    .dashboard-container 
    {
      padding-top: 100px; /* espace sous le menu du haut */
      padding-left: 20px;
      padding-right: 20px;
      margin-left: 200px; /* largeur du menu latéral */
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      min-height: 100vh;
      overflow-x: hidden;
    }

    .card-custom 
    {
      background: linear-gradient(135deg, #ffffff 0%, #f1f5f9 100%);
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(148, 163, 184, 0.25);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(226, 232, 240, 0.8);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      height: 90px;
    }
    
    .card-custom:hover 
    {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(148, 163, 184, 0.35);
    }
    
    .card-icon 
    {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      color: white;
      margin-bottom: 8px;
    }
    
    .icon-sites { background: linear-gradient(45deg, #1f2937, #3b82f6); }       /* bleu foncé vers bleu vif */
    .icon-services { background: linear-gradient(45deg, #065f46, #10b981); }    /* vert foncé vers vert vif */
    .icon-vehicules { background: linear-gradient(45deg, #374151, #6366f1); }   /* gris foncé vers bleu pastel */
    .icon-preneurs { background: linear-gradient(45deg, #854d0e, #f59e0b); }   /* brun foncé vers jaune orangé */
    .icon-users { background: linear-gradient(45deg, #b91c1c, #ef4444); }      /* rouge bordeaux vers rouge vif */
    .icon-bons { background: linear-gradient(45deg, #5b21b6, #8b5cf6); }       /* violet foncé vers violet clair */

    .chart-container 
    {
      background: #ffffff;
      border-radius: 12px;
      padding: 10px;
      box-shadow: 0 4px 20px rgba(148, 163, 184, 0.15);
      border: 1px solid rgba(226, 232, 240, 0.6);
      margin-bottom: 10px;
    }
    
    .chart-container-small 
    {
      height: 200px;
    }
    
    .chart-container-large 
    {
      height: 180px;
    }
    
    .chart-title 
    {
      color: #1e293b;
      font-weight: 600;
      margin-bottom: 10px;
      text-align: center;
      font-size: 1rem;
    }
    
    .card-number 
    {
      font-size: 1.4rem;
      font-weight: bold;
      color: #1e293b;
      margin: 0;
    }
    
    .card-label 
    {
      color: #64748b;
      font-size: 0.8rem;
      margin: 0;
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) 
    {
      .dashboard-container 
      {
        margin-left: 0;
        margin-top: 60px;
      }
    }
  </style>
</head>

<body>
  <div id="menu1">@include('menu2')</div>
  <div id="menu">@include('menu')</div>
  
  <div class="dashboard-container">
    
    <div class="row mb-3">
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-sites">🏢</div>
            <h3 class="card-number">{{ $sites }}</h3>
            <p class="card-label">Sites</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-services">⚙️</div>
            <h3 class="card-number">{{ $services }}</h3>
            <p class="card-label">Services</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-vehicules">🚗</div>
            <h3 class="card-number">{{ $vehicules }}</h3>
            <p class="card-label">Véhicules</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-preneurs">👥</div>
            <h3 class="card-number">{{ $preneurs }}</h3>
            <p class="card-label">Preneurs</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-users">👤</div>
            <h3 class="card-number">{{ $users }}</h3>
            <p class="card-label">Utilisateurs</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-2 mb-2">
        <div class="card card-custom text-center">
          <div class="card-body d-flex flex-column justify-content-center align-items-center">
            <div class="card-icon icon-bons">📋</div>
            <h3 class="card-number">{{ $bons }}</h3>
            <p class="card-label">Bons</p>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Charts Section -->
    <div class="row mb-2">
      <div class="col-md-6">
        <div class="chart-container chart-container-small">
          <h4 class="chart-title">Montant total dépensé par type de carburant (DH)</h4>
          <canvas id="carburantChart"></canvas>
        </div>
    </div>
      
      <div class="col-md-6">
        <div class="chart-container chart-container-small">
          <h4 class="chart-title">Top 5 Véhicules Consommateurs (Litres)</h4>
          <canvas id="vehiculesChart"></canvas>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="chart-container chart-container-large">
          <h4 class="chart-title">Coûts mensuels de carburant (DH)</h4>
          <canvas id="consoChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Configuration des couleurs
    const colors = {
      primary: ['#1f2937', '#3b82f6', '#065f46', '#10b981',  '#5b21b6', '#8b5cf6' ]
    };

    // 1. Graphique en secteurs (Pie) - Répartition par carburant (DH)
    const carburantData = @json($carburant);
    const carburantLabels = carburantData.map(item => item.carburant.toUpperCase());
    const carburantValues = carburantData.map(item => parseFloat(item.total_litres));

    const ctxCarburant = document.getElementById('carburantChart').getContext('2d');
    new Chart(ctxCarburant, {
      type: 'pie',
      data: {
        labels: carburantLabels,
        datasets: [{
          data: carburantValues,
          backgroundColor: colors.primary,
          borderWidth: 2,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 20,
              usePointStyle: true
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                let value = context.parsed || 0;
                return label + ': ' + value.toLocaleString('fr-FR') + ' DH';
              }
            }
          }
        }
      }
    });

    // 2. Graphique en anneau (Doughnut) - Top 5 véhicules (Litres)
    const vehiculesData = @json($vehiculesTop);
    const vehiculesLabels = vehiculesData.map(item => 
    item.vehicule ? `${item.vehicule.marque} ${item.vehicule.modele}` : `Véhicule ${item.vehicule_id}`);
    const vehiculesValues = vehiculesData.map(item => parseFloat(item.total_litres));

    const ctxVehicules = document.getElementById('vehiculesChart').getContext('2d');
    new Chart(ctxVehicules, {
      type: 'doughnut',
      data: {
        labels: vehiculesLabels,
        datasets: [{
          data: vehiculesValues,
          backgroundColor: colors.primary,
          borderWidth: 3,
          borderColor: '#fff'
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'bottom',
            labels: {
              padding: 15,
              usePointStyle: true
            }
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                let value = context.parsed || 0;
                return label + ': ' + value.toLocaleString('fr-FR') + ' litres';
              }
            }
          }
        }
      }
    });

    // 3. Graphique en barres - Consommation mensuelle (DH)
    const consoData = @json($consoMensuelle);
    const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun', 'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
    
    // Créer un tableau de 12 mois avec des valeurs par défaut
    const consoLabels = months;
    const consoValues = new Array(12).fill(0);
    
    // Remplir avec les données réelles
    consoData.forEach(item => {
      const monthIndex = parseInt(item.mois) - 1;
      if (monthIndex >= 0 && monthIndex < 12) {
        consoValues[monthIndex] = parseFloat(item.total_litres);
      }
    });

    const ctxConso = document.getElementById('consoChart').getContext('2d');
    new Chart(ctxConso, {
      type: 'bar',
      data: {
        labels: consoLabels,
        datasets: [{
          label: 'Consommation (DH)',
          data: consoValues,
          backgroundColor: '#4ecdc4',
          borderColor: '#44bd87',
          borderWidth: 2,
          borderRadius: 8,
          borderSkipped: false,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true
          },
          tooltip: {
            callbacks: {
              label: function(context) {
                let value = context.parsed.y || 0;
                return 'Montant : ' + value.toLocaleString('fr-FR') + ' DH';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0,0,0,0.05)'
            },
            ticks: {
              callback: function(value) {
                return value + ' DH';
              }
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  </script>
</body>
</html>
