<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>

    <div id="d1">
        @if(auth()->user()->type !== 'user')
        <div id="menu1">
        @include('menu2')
        </div>
        @else
        <div id="menu1">
        @include('menu3')
        </div>
        @endif
    </div>

    <div style="margin-left:200px;">
    <div class="container">
        <div class="container" style="margin-top:80px;">
            <div class="row justify-content-center align-items-center">
    
                <div class="col-auto">
                <img src="/img/ah.jpg" alt="" width="400px" height="200px" class="img-fluid" />
                </div>
                <div class="col-auto">
                <img src="/img/m1.webp" alt="" width="400px" height="150px" class="img-fluid" />
                </div>
            </div>
        </div>

        
        <div id="menu">
            @include('menu')
        </div>
        
    <h1 class="h1 fw-semibold text-center mb-4 border border-4  px-3 py-2"> Liste de consommation de carburant</h1>

        <a href="/impression-acc-pdf" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
       </a> 

       <a href="/export-excel_acc" class="btn btn-success text-white fw-bold" style="margin-left:800px">
        Exporter vers Excel
       </a>
       <br> <br> <br>
        <table class="table table-bordered table-striped">
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
            <tbody class="tbody">
                <?php
                    $i=0;
                    foreach($bons as $b){
                ?>
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
                    @if(auth()->user()->type !== 'user')
                    <td><a href="/update?id={{$b->id}}" class="btn btn-warning">update</a></td>
                    <td><a href="/delete?id={{$b->id}}" class="btn btn-danger" onclick="return confirm('Le bon sera supprimé définitivement. Veuillez confirmer la suppression.');">delete</a></td>
                    @endif
                </tr>
                <?php 
                $i++;
                } 
            ?>
            </tbody>
        </table>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>