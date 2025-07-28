<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Bon</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/menu.css">
</head>
<body>
    <div class="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br><br>
        <h1 class="h1 text-center">Recherche par n°Bon</h1>
        <div class="d-flex justify-content-center mt-4">
        <form action="" method="get" class="d-flex gap-2 mt-4" style="max-width: 400px;">
            <label for="s" class="form-label"></label><input type="search" class="form-control" value="{{ $motcle ?? '' }}" name="motcle" id="s" placeholder="n°bon">
            <input type="submit" value="rechercher" class="btn btn-primary">
        </form>
        </div>
    <br> <br> 

    @if($bons->isNotEmpty())
    <h1 class="h1 fw-bold text-center">Liste de consomation de caburant par n°bon</h1> <br>
    <a href="/impression-bon-pdf?motcle={{ $motcle }}" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
    </a>

    <a href="/export-excel_nbon?motcle={{ $motcle }}" class="btn btn-success text-white fw-bold" style="margin-left:800px">
        Exporter vers Excel
    </a> <br> <br>
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
                @if(auth()->user()->type !== 'user')
                <th>modifier</th>
                <th>supprimer</th>
                @endif
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
                    @if(auth()->user()->type !== 'user')
                    <td><a href="/update?id={{$b->id}}" class="btn btn-warning">update</a></td>
                    <td><a href="/delete?id={{$b->id}}" class="btn btn-danger">delete</a></td>
                    @endif
                </tr>
            </tbody>
            <?php 
                } 
            ?>
        </table>
        @elseif(!empty($motcle))
        <p class="text-center text-danger fw-bold">le N°Bon saisis n'est pas disponible</p>
        @endif
        </div>
</body>
</html>