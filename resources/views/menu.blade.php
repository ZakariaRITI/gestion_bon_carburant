<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Menu -->
<nav id="menu" class="bg-dark shadow-sm">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link text-white fw-semibold px-3" href="/acc">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white fw-semibold px-3" href="/ab">Ajouter</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Rechercher
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="/searchb">Par n° Bon</a></li>
          <li><a class="dropdown-item" href="/searchm">Par n° Matricule</a></li>
          <li><a class="dropdown-item" href="/searchv">Par n° Véhicule</a></li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link text-white fw-semibold px-3" href="/pc">Prix carburant</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-white fw-semibold px-3" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Imprimer
        </a>
        <ul class="dropdown-menu">
          <li><button class="dropdown-item" onclick="openModal('site')">Par Site</button></li>
          <li><button class="dropdown-item" onclick="openModal('service')">Par Service</button></li>
          <li><button class="dropdown-item" onclick="openModal('vehicule')">Par Véhicule</button></li>
          <li><button class="dropdown-item" onclick="openModal('preneur')">Par Preneur</button></li>
          <li><button class="dropdown-item" onclick="openModal('journee')">Par Journée</button></li>
        </ul>
      </li>
    </ul>

    <ul class="nav align-items-center">
      <li class="nav-item me-3 text-white fw-bold">{{ Auth::user()->name }}</li>
      <li class="nav-item me-2">
        <a class="nav-link" href="/profile">
          <img src="/img/pro.png" alt="Profil" height="40">
        </a>
      </li>
      <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn btn-danger px-3 py-1 fw-semibold">
            <img src="/img/deco.png" alt="Déconnexion" height="35">
          </button>
        </form>
      </li>
    </ul>
  </div>
</nav>

<!--Modal-->
<div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="dateModalLabel" aria-hidden="true" data-bs-backdrop="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModalLabel">Sélectionner la période</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <form id="dateForm">    
          <div class="mb-3">
            <label for="startDate" class="form-label">Date de début</label>
            <input type="date" class="form-control" id="startDate" required>
          </div>
          <div class="mb-3">
            <label for="endDate" class="form-label">Date de fin</label>
            <input type="date" class="form-control" id="endDate" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" onclick="submitDates()">Valider</button>
      </div>
    </div>
  </div>
</div>

<script>
let currentImpressionType = '';

function openModal(type) 
{
    currentImpressionType = type; // enregistre le type d’impression
    const modal = new bootstrap.Modal(document.getElementById('dateModal'));
    modal.show();
}

function submitDates() 
{
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;

    if (!startDate || !endDate) {
        alert("Veuillez sélectionner les deux dates.");
        return;
    }

    // Redirection vers la page avec paramètres GET
    window.location.href = `/impression/${currentImpressionType}?start=${startDate}&end=${endDate}`;
}
</script>

</body>
</html>