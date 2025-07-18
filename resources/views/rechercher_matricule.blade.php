<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Matricule</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/menu.css">
</head>
<body>
    <div class="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br><br>
        <h1 class="h1 text-center">Recherche par n°Matricule du preneur</h1>
        <div class="d-flex justify-content-center mt-4">
        <form action="" method="get" class="d-flex gap-2 mt-4" style="max-width: 400px;">
            <label for="s" class="form-label"></label><input type="search" class="form-control" value="{{ $motcle ?? '' }}" name="motcle" id="s" placeholder="n°matricule">
            <input type="submit" value="rechercher" class="btn btn-primary">
        </div>
        </form>
    <br> <br>
    @if($bons->isNotEmpty())
    <a href="/impression-matricule-pdf?motcle={{ $motcle }}" target="_blank" class="btn btn-success float-end fw-bold">
            Télécharger / Imprimer PDF
    </a>
    <h2 class="h2 fw-bold text-center">Liste de consomation de caburant par n°Matricule du preneur</h2> <br>
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
                    <td><?php echo $b->site->nom_site ?></td>
                    <td><?php echo $b->service->nom_service ?></td>
                    <td><?php echo $b->vehicule->n_vehicule ?></td>
                    <td><?php echo $b->preneur->nom ?></td>
                    <td><?php echo $b->utilisateur->name ?></td>
                    <td><a href="" class="btn btn-warning">update</a></td>
                    <td><a href="" class="btn btn-danger">delete</a></td>
                </tr>
            </tbody>
            <?php 
                } 
            ?>
        </table>
        @elseif(!empty($motcle))
        <p class="text-center text-danger fw-bold">le n°matricule saisis n'est pas disponible</p>
        @endif
        </div>
</body>
</html>