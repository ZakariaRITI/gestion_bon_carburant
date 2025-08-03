<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Menu2</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>
  <div id="menu1">
    
    <img src="/img/logo3.png" alt="Logo" height="185" width="200" style="margin-top:50px;"/>
    <ul class="nav flex-column bg-dark p-3">
      <li class="nav-item"><a href="/dashbord" class="nav-link fs-4 fw-bold text-white">Tableau de bord</a></li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Site
        </a>
        <ul class="dropdown-menu" aria-labelledby="siteDropdown">
          <li><a class="dropdown-item fw-bold" href="/as">Ajouter site</a></li>
          <li><a class="dropdown-item fw-bold" href="/ds">Gestion site</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="serviceDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Service
        </a>
        <ul class="dropdown-menu" aria-labelledby="serviceDropdown">
          <li><a class="dropdown-item fw-bold" href="/aservice">Ajouter service</a></li>
          <li><a class="dropdown-item fw-bold" href="/gservice">Gestion service</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="vehiculeDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Vehicule
        </a>
        <ul class="dropdown-menu" aria-labelledby="vehiculeDropdown">
          <li><a class="dropdown-item fw-bold" href="/avehicule">Ajouter Vehicule</a></li>
          <li><a class="dropdown-item fw-bold" href="/gvehicule">Gestion Vehicule</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="preneurDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Preneur
        </a>
        <ul class="dropdown-menu" aria-labelledby="preneurDropdown">
          <li><a class="dropdown-item fw-bold" href="/apreneur">Ajouter Preneur</a></li>
          <li><a class="dropdown-item fw-bold" href="/gpreneur">Gestion Preneur</a></li>
        </ul>
      </li>

      <li class="nav-item dropdown">
        <a href="#" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="utilisateurDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Utilisateur
        </a>
        <ul class="dropdown-menu" aria-labelledby="utilisateurDropdown">
          <li><a class="dropdown-item fw-bold" href="/auser">Ajouter Utilisateur</a></li>
          <li><a class="dropdown-item fw-bold" href="/guser">Gestion Utilisateur</a></li>
        </ul>
      </li>

      <li class="nav-item"><a href="/support" class="nav-link fs-4 fw-bold text-white">Support & Aide</a></li>

      <li><hr class="my-2" /></li>

      <!-- Placeholder/support links -->
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
      <li class="nav-item"><a href="#" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
    </ul>
  </div>

  <!-- Bootstrap Bundle JS (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
