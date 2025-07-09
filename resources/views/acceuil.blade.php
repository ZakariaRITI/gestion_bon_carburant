<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <link rel="stylesheet" href="/css/menu.css">
</head>
<body>

<div id="d1">
    <div id="menu1">
        <ul class="nav flex-column bg-dark p-3">
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">----------</a></li>
        </ul>
        <img src="/img/logo2.jpg" alt="" height="150px" width="200px">
        <ul class="nav flex-column bg-dark p-3">
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-white">Tableau de bord</a></li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Site
                </a>
                 <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Ajouter site</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Gestion site</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Service
                </a>
                 <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Ajouter service</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Gestion service</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Vehicule
                </a>
                 <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Ajouter Vehicule</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Gestion Vehicule</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Preneur
                </a>
                 <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Ajouter Preneur</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Gestion Preneur</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="" class="nav-link fs-4 fw-bold text-white dropdown-toggle" id="siteDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Utilisateur
                </a>
                 <ul class="dropdown-menu bg-dark ml-5" aria-labelledby="siteDropdown">
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Ajouter Utilisateur</a></li>
                    <li><a class="dropdown-item text-dark fw-bold bg-light" href="#">Gestion Utilisateur</a></li>
                </ul>
            </li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-white">Support & Aide</a></li>
            <li><hr class="my-2" style="border-top: 1px solid black; width: 100%;"></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">_________</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
            <li class="nav-item"><a href="" class="nav-link fs-4 fw-bold text-dark">Support</a></li>
        </ul>
    </div>

    <div style="margin-left:200px;">
    <div class="container">
        <img src="/img/1.jpeg" alt="" class="mx-auto d-block mt-5" width="800px" height="300px">
        <div id="menu">
            @include('menu')
        </div>
        
        <h1 class="h1 fw-bold">Liste de consomation de caburant </h1>
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                <th>n° Bon</th>
                <th>type carburant</th>
                <th>quantite</th>
                <th>prix</th>
                <th>total</th>
                <th>date_bon</th>
                <th>date_saisis</th>
                <th>site</th>
                <th>service</th>
                <th>n°vehicule</th>
                <th>nom preneur</th>
                <th>saisis par</th>
                <th>modifier</th>
                <th>supprimer</th>
                </tr>
            </thead>
                <?php
                $i=0;
                    foreach($bons as $b){
                ?>
            <tbody class="tbody">
                <tr>
                    <td><?php echo $b->n_bon ?></td>
                    <td><?php echo $b->type_carburant ?></td>
                    <td><?php echo $b->quantite ?></td>
                    <td><?php echo $b->prix ?></td>
                    <td><?php echo $b->total ?></td>
                    <td><?php echo $b->date_bon ?></td>
                    <td><?php echo $b->date_saisis ?></td>
                    <td><?php echo $si[$i]->nom_site ?></td>
                    <td><?php echo $se[$i]->nom_service ?></td>
                    <td><?php echo $ve[$i]->n_vehicule ?></td>
                    <td><?php echo $pr[$i]->nom ?></td>
                    <td><?php echo $ut[$i]->name ?></td>
                    <td><a href="" class="btn btn-warning">update</a></td>
                    <td><a href="" class="btn btn-danger">delete</a></td>
                </tr>
            </tbody>
            <?php 
                $i++;
                } 
            ?>
        </table>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>