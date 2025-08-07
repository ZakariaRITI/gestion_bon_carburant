<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Utilisateur</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #0f172a, #0ea5e9);
            color: #1e293b;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
        }

        .main-container {
            padding: 80px 20px;
        }

        .page-title {
            color: #fff;
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 50px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-container {
            max-width: 600px;
            margin: auto;
        }

        .form-card {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            font-weight: 600;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            font-size: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: #f8fafc;
            margin-bottom: 20px;
            transition: 0.3s;
        }

        .form-input:focus {
            border-color: #0ea5e9;
            outline: none;
            box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(to right, #0f172a, #0ea5e9);
            color: white;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            font-weight: 500;
            animation: fadeIn 0.3s ease-in-out;
            max-width: 500px;        /* ✅ Limite la largeur */
    margin: 0 auto 30px;     /* ✅ Centre l'alerte horizontalement */
    text-align: center;      /* ✅ Texte centré (optionnel) */
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 40px 30px;
            }

            .page-title {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>

    <div id="menu1">@include('menu2')</div>

    <div class="main-container">
        <div id="menu">@include('menu')</div>

        <h1 class="page-title">AJOUT UTILISATEUR</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="form-container">
            <div class="form-card">
                <form action="/ajuser" method="post" id="form" autocomplete="off">
                    @csrf
                    <input type="text" name="fake_username" style="display:none" autocomplete="off">

                    <label for="cs" class="form-label">Nom</label>
                    <input type="text" id="cs" name="nom" class="form-input" value="{{ old('nom') }}" placeholder="Nom complet">

                    <label for="ns" class="form-label">Email</label>
                    <input type="email" id="ns" name="user_email" class="form-input" value="{{ old('user_email') }}" placeholder="exemple@email.com">

                    <label for="pwd" class="form-label">Mot de passe</label>
                    <input type="password" id="pwd" name="user_password" class="form-input" placeholder="********">

                    <label for="type" class="form-label">Type</label>
                    <select id="type" name="type" class="form-input">
                        <option value="">----- Sélectionner un type -----</option>
                        <option value="admin" {{ old('type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('type') == 'user' ? 'selected' : '' }}>User</option>
                    </select>

                    <button type="submit" class="submit-btn">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("form").addEventListener("submit", function(e) {
            const nom = document.getElementById('cs').value.trim();
            const email = document.getElementById('ns').value.trim();
            const password = document.getElementById('pwd').value.trim();
            const type = document.getElementById('type').value;

            if (nom === "" || email === "" || password === "" || type === "") {
                e.preventDefault();
                alert("Veuillez remplir tous les champs.");
                return;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert("Veuillez entrer une adresse email valide.");
                return;
            }

            if (password.length < 6) {
                e.preventDefault();
                alert("Le mot de passe doit contenir au moins 6 caractères.");
                return;
            }
        });
    </script>
</body>
</html>
