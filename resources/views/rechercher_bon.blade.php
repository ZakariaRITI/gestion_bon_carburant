<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher Bon</title>
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
    <div class="container" style="margin-left:200px;">

        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br><br>
        <h1 class="h1 text-center mb-4 fw-bold" style="color:#0f172a; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">
    Recherche par n°Bon
</h1>

<div class="d-flex justify-content-center">
    <form action="" method="get" class="d-flex gap-2" style="max-width: 400px; width: 100%;">
        <input 
            type="search" 
            class="form-control shadow-sm border-0 rounded-3" 
            value="{{ $motcle ?? '' }}" 
            name="motcle" 
            id="s" 
            placeholder="Entrez le n° bon" 
            style="padding: 12px 20px; font-size: 1.1rem;"
        >
        <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm" style="font-size: 1.1rem;">
            Rechercher
        </button>
    </form>
</div> <br> 
    <hr class="border-4">

    @if($bons->isNotEmpty())
    <h1 class="h1 fw-bold text-center">Liste de consomation de caburant par n°bon</h1> <br>
    <a href="/impression-bon-pdf?motcle={{ $motcle }}" target="_blank" class="btn btn-danger float-end fw-bold">
            Télécharger / Imprimer PDF
    </a>

    <a href="/export-excel_nbon?motcle={{ $motcle }}" class="btn btn-success text-white fw-bold" style="margin-left:800px">
        Exporter vers Excel
    </a> <br> <br>
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
            <td><a href="/update?id={{$b->id}}" class="btn btn-edit-pro"><img src="/img/modifier.png" alt="" height="15px" width="15px"></a></td>
            <td><a href="/delete?id={{$b->id}}" class="btn btn-delete-pro" onclick="return confirm('Le bon sera supprimé définitivement. Veuillez confirmer la suppression.');"><img src="/img/supprimer.png" alt="" height="15px" width="15px"></a></td>
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
</body>
</html>