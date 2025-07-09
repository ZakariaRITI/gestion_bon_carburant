<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Bon</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">    
</head>
<body>
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br>
    <div class="container">
        <h1 class="h3 my-4 text-center text-dark fw-bold">Ajouter un Bon de carburant</h1>
        <div class="card shadow-sm p-4 bg-light border-0 rounded-3">
        <form action="/save" method="get" class="form col-md-6 mx-auto" id="form">
            @csrf
            <label for="nb" class="form-label">n°Bon:</label><input type="text" id="nb" name="n_bon" class="form-control" required value="{{ old('n_bon') }}">
            @error('n_bon')
            <div class="text-danger">{{ $message }}</div>
            @enderror
            <label for="tc" class="form-label">type carburant:</label> 
                <select name="type_carburant" id="tc" class="form-select" required>
                    <option value="">---Selectionner---</option>
                    @foreach($carburant as $carb)
                        <option value="{{ $carb->type }}" data-prix="{{ $carb->prix }}">{{ $carb->type }}</option>
                    @endforeach
                </select>
            <label for="p" class="form-label">prix:</label> <input type="text" id="p" name="prix" class="form-control" readonly>
            <label for="q" class="form-label">quantite(L):</label><br><input type="number" step="0.5" class="form-control" name="quantite" id="q" min="0" required> <br>
            <label for="db" class="form-label">date_bon:</label> <br> <input type="date" id="db" name="date_bon" class="form-date" required> <br>
            <label for="ds" class="form-label">date_saisis:</label><br> <input type="date" id="ds" name="date_saisis" class="form-date" required><br>
            <label for="s" class="form-label">site:</label><br>
            <select name="site" id="s" class="form-select" required>
                <option value="">---Selectionner un site---</option>
                @foreach($sites as $s)
                <option value="{{$s->id}}">{{$s->nom_site}}</option>
                @endforeach
            </select>
            <label for="se" class="form-label">service:</label>
            <select name="service" id="se" class="form-select" required>
                <option value="">---Selectionner un service---</option>
                @foreach($services as $se)
                <option value="{{$se->id}}">{{$se->nom_service}}</option>
                @endforeach
            </select>
            <label for="nv" class="form-label">n° vehicule:</label>
            <select name="n_vehicule" id="nv" class="form-select" required>
                <option value="">---Selectionner un vehicule---</option>
                @foreach($vehicules as $v)
                <option value="{{$v->id}}">{{$v->n_vehicule}}</option>
                @endforeach
            </select>
            <label for="p" class="form-label">preneur:</label>
            <select name="preneur" id="p" class="form-select" required>
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

         document.getElementById('form').addEventListener('submit', function(e)
         {
            const nb = document.getElementById('nb').value.trim();

            if (nb.length !== 6) 
            {
                e.preventDefault(); // empêcher l'envoi
                alert("Le n° bon doit être composé de 6 chiffres.");
            }
         });
    </script>

</body>
</html>