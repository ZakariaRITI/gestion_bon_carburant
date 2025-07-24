<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update vehicule</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>
    <div id="menu1">
        @include('menu2')
    </div>
    <div class ="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br> <br>
        <h1 class="h1 fw-bold">MODIFIER VEHICULE</h1>
        @if(session('error'))
            <div class="alert alert-danger w-50 mx-auto">
                {{ session('error') }}
            </div>
        @endif
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                     <form action="/saveupdatevehicule" method="post" class="p-4 border rounded shadow" id="form">
                        @csrf
                        <div class="mb-3">
                        <label for="cs" class="form-label"> Numero vehicule :</label>
                        <input type="text" id="cs" name="codevehicule" class="form-control" min="1" value="{{ old('codevehicule', $vehicule->n_vehicule)}}">
                        </div>
                        <div class="mb-3">
                        <label for="ns" class="form-label">Marque :</label>
                        <input type="text" id="ns" name="marque" class="form-control" value="{{ old('marque', $vehicule->marque)}}">
                        </div>
                        <div class="mb-3">
                        <label for="m" class="form-label">Modele :</label>
                        <input type="text" id="m" name="modele" class="form-control" value="{{ old('modele', $vehicule->modele)}}">
                        </div>
                        <input type="hidden" name="id" value="{{ $vehicule->id }}">
                        <button type="submit" class="btn btn-warning w-100">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("form").addEventListener("submit", function(e) 
        {
            code=document.getElementById('cs').value;
            nom=document.getElementById('ns').value;

            if(code =="" || nom=="")
                {   
                e.preventDefault();
                alert("Veuillez remplir les champs");
                }

            if(code !="")  
                {
                if (code.length!=7)
                {
                e.preventDefault();
                alert("Le code service doit avoir 7 caracteres(ex: 0000-X0)");
                }    
                }    
        });
    </script>
</body>
</html>