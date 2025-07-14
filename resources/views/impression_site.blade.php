<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impression Site</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div id="menu">
            @include('menu')
    </div> <br> <br> <br> <br> <br>

    <div class="container">
        <span class="fw-bold">Auto hall</span> <span id="jour" style="margin-left:1000px;"></span>
        <hr class="border border-dark my-4">    
        <div class="text-center">
        <h4 class="border p-1 d-inline-block">ETAT RECAPITULATIF PAR SITE</h4>

        <p class="text-center">Pour la période:&nbsp;  de &nbsp; {{ $start }} &nbsp; à &nbsp; {{$end}} </p> <br> <br> <br>

        <table class="table table-bordered border-dark">
        <thead class="thead">
            <tr class="text-center">
                <th colspan="2">SITE</th>
                <th colspan="2">ESSENCE</th>
                <th colspan="2">GASOIL</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody class="tbody">
            <tr>
                <td>code</td>
                <td>nom</td>
                <td>Quantite</td>
                <td>Valeur</td>
                <td>Quantite</td>
                <td>Valeur</td>
            </tr>
            <?php
                foreach($bons as $site => $carburants){
                    $essence = $carburants->firstWhere('type_carburant', 'ESSENCE');
                    $gasoil  = $carburants->firstWhere('type_carburant', 'GASOIL');
            ?>
            <tr>
                <td>{{ $site }}</td>
                <td>{{ $essence->total_quantite ?? 0 }}</td>
                <td>{{ $essence->total_valeur ?? 0 }}</td>
                <td>{{ $gasoil->total_quantite ?? 0 }}</td>
                <td>{{ $gasoil->total_valeur ?? 0 }}</td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>

    <script>
        const today = new Date();

        // Format jour/mois/année
        const dateFr = today.toLocaleDateString('fr-FR');
        let h = today.getHours().toString().padStart(2, '0');
        let m = today.getMinutes().toString().padStart(2, '0');
        let s = today.getSeconds().toString().padStart(2, '0');

        document.getElementById("jour").textContent="Le "+dateFr+" à "+`${h}:${m}`;
    </script>
</body>
</html>