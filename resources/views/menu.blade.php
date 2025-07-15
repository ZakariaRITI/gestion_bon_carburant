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
    <div class="container-fluid bg-secondary mt-3">
        <ul class="nav bg-secondary p-2 rounded">
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href="/acc">Acceuil</a></li>
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href="/ab">Ajouter</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link text-white fs-4 fw-bold dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="">
                Rechercher
            </a>
             <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="/searchb" style="transition: 0.3s;" onmouseover="this.classList.add('bg-dark','text-white');" onmouseout="this.classList.remove('bg-dark','text-white');">par n° Bon</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="/searchm" style="transition: 0.3s;" onmouseover="this.classList.add('bg-dark','text-white');" onmouseout="this.classList.remove('bg-dark','text-white');">par n° Matricule</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="/searchv" style="transition: 0.3s;" onmouseover="this.classList.add('bg-dark','text-white');" onmouseout="this.classList.remove('bg-dark','text-white');">par n° Vehicule</a></li>
             </ul>
        </li>
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href="/pc">Prix carburant</a></li>
        <li class="nav-item dropdown" style="margin-right: 150px;">
  <a class="nav-link text-white fs-4 fw-bold dropdown-toggle" id="impDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" href="#">
    Impression
  </a>
  <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="impDropdown">
    <li>
      <button class="dropdown-item text-dark fw-bold bg-light" onclick="openModal('site')">
        par Site
      </button>
    </li>
    <li>
      <button class="dropdown-item text-dark fw-bold bg-light" onclick="openModal('service')">
        par Service
      </button>
    </li>
    <li>
      <button class="dropdown-item text-dark fw-bold bg-light" onclick="openModal('vehicule')">
        par Vehicule
      </button>
    </li>
    <li>
      <button class="dropdown-item text-dark fw-bold bg-light" onclick="openModal('preneur')">
        par Preneur
      </button>
    </li>
    <li>
      <button class="dropdown-item text-dark fw-bold bg-light" onclick="openModal('journee')">
        par Journee
      </button>
    </li>
  </ul>
</li>

        <li class="nav-item fs-3 text-info fw-bold" style="margin-right: 100px;">{{ Auth::user()->name }}</li>
        <li class="nav-item me-3"><a class="nav-link text-white fs-4 fw-bold bg-info mt-2" href="/profile"><img src="/img/pro.png" alt="" height="47px"></a></li>
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                 @csrf
            <button type="submit" class="btn d-block mx-auto mt-2 fw-bold fs-5 bg-danger text-white shadow-sm" style="transition: all 0.3s ease;"><img src="/img/deco.png" alt="" height="50px"></button>
            </form>
        </li>
    </ul>
    </div>

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

function openModal(type) {
    currentImpressionType = type; // enregistre le type d’impression
    const modal = new bootstrap.Modal(document.getElementById('dateModal'));
    modal.show();
}

function submitDates() {
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