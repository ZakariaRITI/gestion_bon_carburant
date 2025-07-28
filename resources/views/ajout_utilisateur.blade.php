<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Utilisateur</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
</head>
<body>

    <div id="menu1">
        @include('menu2')
    </div>


    <div class="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br> <br>
        <h1 class="h1 fw-bold text-center">AJOUT UTILISATEUR</h1>
       
        @if(session('success'))
        <div class="alert alert-success w-50 mx-auto">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger w-50 mx-auto">
                {{ session('error') }}
            </div>
        @endif

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                     <form action="/ajuser" method="post" class="p-4 border rounded shadow" id="form" autocomplete="off">
                        @csrf
                        <input type="text" name="fake_username" style="display:none" autocomplete="off">
                        <div class="mb-3">
                        <label for="cs" class="form-label">Nom :</label>
                        <input type="text" id="cs" name="nom" class="form-control" value="{{ old('nom') }}">
                        </div>
                        <div class="mb-3">
                        <label for="ns" class="form-label">Email :</label>
                        <input type="email" id="ns" name="user_email" class="form-control" value="{{ old('email') }}">
                        </div>
                        <div class="mb-3">
                        <label for="pwd" class="form-label">Password :</label>
                        <input type="password" id="pwd" name="user_password" class="form-control">
                        </div>
                        <div class="mb-3">
                        <label for="type" class="form-label">Type :</label>
                        <select id="type" name="type" class="form-control">
                            <option value="">-----Selectionner un type-----</option>
                            <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("form").addEventListener("submit", function(e) 
        {
            nom=document.getElementById('cs').value;
            email=document.getElementById('ns').value;
            password=document.getElementById('pwd').value;
            type=document.getElementById('type').value;

            if(nom =="" || email=="" || password=="" || type=="")
                {   
                e.preventDefault();
                alert("Veuillez remplir les champs");
                return;
                }
            
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) 
                {
                e.preventDefault();
                alert("Veuillez entrer une adresse email valide.");
                return;
                }    
        });
    </script>
</body>
</html>