<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Bon</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    @include('menu')
    <div class="container">
        <h1 class="h3 my-4 text-center text-primary fw-bold">Ajouter un Bon de carburant</h1>
        <div class="card shadow-sm p-4 bg-light border-0 rounded-3">
        <form action="/save" method="get" class="form col-md-6 mx-auto">
            @csrf
            <label for="nb" class="form-label">n°Bon:</label><input type="text" id="nb" name="n_bon" class="form-control">
            <label for="tc" class="form-label">type carburant:</label> 
                <select name="type_carburant" id="tc" class="form-select">
                    <option value="">---Selectionner---</option>
                    @foreach($carburant as $carb)
                        <option value="{{ $carb->id }}" data-prix="{{ $carb->prix }}">{{ $carb->type }}</option>
                    @endforeach
                </select>
            <label for="p" class="form-label">prix:</label> <input type="text" id="p" name="prix" class="form-control" readonly>
            <label for="q" class="form-label">quantite(L):</label><br><input type="number" class="form-number" name="quantite" id="q"> <br>
            <label for="db" class="form-label">date_bon:</label> <br> <input type="date" id="db" name="date_bon" class="form-date"> <br>
            <label for="ds" class="form-label">date_saisis:</label><br> <input type="date" id="ds" name="date_saisis" class="form-date"><br>
            <label for="s" class="form-label">site:</label><br>
            <select name="site" id="s" class="form-select">
                <option value="">---Selectionner un site---</option>
                @foreach($sites as $s)
                <option value="{{$s->id}}">{{$s->nom_site}}</option>
                @endforeach
            </select>
            <label for="se" class="form-label">service:</label>
            <select name="service" id="se" class="form-select">
                <option value="">---Selectionner un service---</option>
                @foreach($services as $se)
                <option value="{{$se->id}}">{{$se->nom_service}}</option>
                @endforeach
            </select>
            <label for="nv" class="form-label">n° vehicule:</label>
            <select name="n_vehicule" id="nv" class="form-select">
                <option value="">---Selectionner un vehicule---</option>
                @foreach($vehicules as $v)
                <option value="{{$v->id}}">{{$v->n_vehicule}}</option>
                @endforeach
            </select>
            <label for="p" class="form-label">preneur:</label>
            <select name="preneur" id="p" class="form-select">
                <option value="">---Selectionner un preneur---</option>
                @foreach($preneurs as $p)
                <option value="{{$p->id}}">{{$p->n_matricule}}</option>
                @endforeach
            </select>
            <input type="hidden" name="user" value="{{Auth::user()->id}}">
            <div class="text-center mt-4">
            <input type="submit" value="ajouter" class="btn btn-primary px-4 py-2"> 
            </div>
        </form>
        </div>
    </div>
    <script>
        document.getElementById('tc').addEventListener('change', function() 
        {
        const prix = this.options[this.selectedIndex].getAttribute('data-prix');
        document.getElementById('p').value = prix || '';
        });
    </script>

</body>
</html>