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
                <img src="/img/11.jpg" alt="" width="400px" height="200px" />
                </div>
                <div class="col-auto">
                <img src="/img/ah.jpg" alt="" width="300px" height="200px" />
                </div>
                <div class="col-auto">
                <img src="/img/m1.webp" alt="" width="300px" height="200px" />
                </div>
            </div>
        </div>
        <hr class="border-4">
        <div id="menu">
            @include('menu')
        </div>
        
        <h1 class="text-center display-5 fw-bold py-3 px-2 bg-light border-top border-bottom border-2 shadow-sm mt-3 mb-4">
            Liste de consommation de carburant
        </h1>

        <a href="/impression-acc-pdf" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
        </a> 

       <a href="/export-excel_acc" class="btn btn-success text-white fw-bold" style="margin-left:850px">
        Exporter vers Excel
       </a>
       <br> <br>

        @if(session('success'))
        <div class="alert alert-success w-50 mx-auto">
        {{ session('success') }}
        </div>
         @endif

       <table class="table table-bordered table-striped professional-table">
        <thead class="table-header">
        <tr>
            <th class="col-bon">n° Bon</th>
            <th class="col-carburant">type carburant</th>
            <th class="col-qty">Qté</th>
            <th class="col-prix">prix</th>
            <th class="col-total">total</th>
            <th class="col-date">date_bon</th>
            <th class="col-date">date_saisis</th>
            <th class="col-site">site</th>
            <th class="col-service">service</th>
            <th class="col-vehicule">vehicule</th>
            <th class="col-preneur">nom preneur</th>
            <th class="col-saisie">saisis par</th>
            @if(auth()->user()->type !== 'user')
            <th class="col-action">modifier</th>
            <th class="col-action">supprimer</th>
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
            <td><?php echo number_format($b->quantite, 2); ?></td>
            <td><?php echo number_format($b->prix, 2); ?></td>
            <td><?php echo number_format($b->total, 2); ?></td>
            <td><?php echo $b->date_bon ?></td>
            <td><?php echo $b->date_saisis ?></td>
            <td><?php echo $si[$i]->nom_site ?></td>
            <td><?php echo $se[$i]->nom_service ?></td>
            <td><?php echo $ve[$i]->n_vehicule ?></td>
            <td><?php echo $pr[$i]->nom ?></td>
            <td><?php echo $ut[$i]->name ?></td>
            @if(auth()->user()->type !== 'user')
            <td><a href="/update?id={{$b->id}}" class="btn btn-edit-pro"><img src="/img/modifier.png" alt="" height="15px" width="15px"></a></td>
            <td><a href="/delete?id={{$b->id}}" class="btn btn-delete-pro" onclick="return confirm('Le bon sera supprimé définitivement. Veuillez confirmer la suppression.');"><img src="/img/supprimer.png" alt="" height="15px" width="15px"></a></td>
            @endif
        </tr>
        <?php
        $i++;
        }
        ?>
        </tbody>
        </table>

<style>
.table-header {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
}

.table-header th {
    background: transparent;
    color: #ffffff;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.3px;
    padding: 0.9rem 0.4rem;
    border: none;
    text-align: center;
    position: relative;
    overflow: visible;
    word-wrap: break-word;
    white-space: normal;
    line-height: 1.2;
}
</style>
    </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>