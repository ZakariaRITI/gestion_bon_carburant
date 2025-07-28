<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
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
        <h1 class="h1 fw-bold">MODIFIER USER</h1>
        @if(session('error'))
            <div class="alert alert-danger w-50 mx-auto">
                {{ session('error') }}
            </div>
        @endif
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                     <form action="/saveupdateuser" method="post" class="p-4 border rounded shadow" id="form">
                        @csrf
                        <input type="text" name="fake_username" style="display:none" autocomplete="off">
                        <div class="mb-3">
                        <label for="cs" class="form-label">NOM :</label>
                        <input type="text" id="cs" name="user_nom" class="form-control" value="{{ old('nom', $user->name) }}">
                        </div>
                        <div class="mb-3">
                        <label for="ns" class="form-label">EMAIL :</label>
                        <input type="email" id="ns" name="user_email" class="form-control" value="{{ old('email', $user->email) }}">
                        </div>
                        <div class="mb-3">
                        <label for="p" class="form-label">PASSWORD :</label>
                        <input type="password" id="p" name="pwd" class="form-control" placeholder="new password">
                        </div>
                        <div class="mb-3">
                        <label for="t" class="form-label">TYPE :</label>
                        <select id="type" name="type" class="form-control">
                        <option value="admin" {{ old('type', $user->type) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('type', $user->type) == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        <small class="text-muted">Type actuel : {{ $user->type }}</small>
                         </div>
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-warning w-100">Modifier</button>
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
            pwd=document.getElementById('p').value;
            type=document.getElementById('type').value;

            if(nom =="" || email=="" || pwd=="" || type="")
                {   
                e.preventDefault();
                alert("Veuillez remplir les champs");
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