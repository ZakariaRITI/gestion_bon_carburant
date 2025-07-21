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
                </tr>
            </tbody>
            <?php 
                } 
            ?>
        </table>
        </div>
</body>
</html>