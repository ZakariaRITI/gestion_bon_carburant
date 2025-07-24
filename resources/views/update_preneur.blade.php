<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update preneur</title>
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
        <h1 class="h1 fw-bold">MODIFIER Preneur</h1>
        @if(session('error'))
            <div class="alert alert-danger w-50 mx-auto">
                {{ session('error') }}
            </div>
        @endif
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                     <form action="/saveupdatepreneur" method="post" class="p-4 border rounded shadow" id="form">
                        @csrf
                        <div class="mb-3">
                        <label for="cs" class="form-label">Matricule :</label>
                        <input type="text" id="cs" name="matricule" class="form-control" min="1" value="{{ old('matricule', $preneur->n_matricule) }}">
                        </div>
                        <div class="mb-3">
                        <label for="ns" class="form-label">Nom  :</label>
                        <input type="text" id="ns" name="nom" class="form-control" value="{{ old('nom', $preneur->nom) }}">
                        </div>
                        <input type="hidden" name="id" value="{{ $preneur->id }}">
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

            const regex = /^\d{6}$/;
            if(code!=""){
            if (!regex.test(code)) 
            {
                e.preventDefault();
                alert("Le code service doit contenir exactement 6 chiffres (ex: 123456)");
            }}   
        });
    </script>
</body>
</html>