<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid bg-secondary mt-3">
        <ul class="nav">
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href="/acc">Acceuil</a></li>
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href="/ab">Ajouter</a></li>
        <li class="nav-item dropdown">
            <a class="nav-link text-white fs-4 fw-bold dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"" href="">
                Rechercher
            </a>
             <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">par n° Bon</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">par n° Matricule</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">par n° Vehicule</a></li>
                </ul>
        </li>
        <li class="nav-item" style="margin-right: 400px;"><a class="nav-link text-white fs-4 fw-bold" href="">Imprimer</a></li>
        <li class="nav-item fs-3 text-info fw-bold" style="margin-right: 100px;">{{ Auth::user()->name }}</li>
        <li class="nav-item"><a class="nav-link text-white fs-4 fw-bold" href=""><img src="/img/pro.png" alt="" height="50px"></a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                 @csrf
            <button type="submit" class="btn d-block mx-auto mt-2 fw-bold fs-5"><img src="/img/deco.png" alt="" height="40px"></button>
            </form>
        </li>
    </ul>
    </div>
</body>
</html>