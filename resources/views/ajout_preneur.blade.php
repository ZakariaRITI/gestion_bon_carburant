<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Preneur</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }

        .main-container {
            padding: 80px 20px 40px 20px;
        }

        .page-title {
            color: #ffffff;
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 50px;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .form-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            transition: 0.3s ease;
        }

        .form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            display: block;
            font-weight: 600;
            margin-bottom: 10px;
            text-transform: uppercase;
            font-size: 14px;
            color: #1e293b;
        }

        .form-input {
            width: 100%;
            padding: 16px 20px;
            font-size: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            transition: 0.3s ease;
            background: #f8fafc;
        }

        .form-input:focus {
            border-color: #0ea5e9;
            outline: none;
            box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.1);
        }

        .submit-btn {
            width: 100%;
            padding: 20px;
            background: linear-gradient(to right, #0f172a, #0ea5e9);
            border: none;
            color: white;
            font-weight: 700;
            font-size: 16px;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
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
            animation: slideIn 0.3s ease;
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

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 40px 30px;
            }

            .page-title {
                font-size: 2rem;
                margin-bottom: 30px;
            }
        }
    </style>
</head>
<body>

    <div id="menu1">@include('menu2')</div>

    <div class="main-container">
        <div id="menu">@include('menu')</div>

        <h1 class="page-title">AJOUT PRENEUR</h1>

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
                <form action="/ajpreneur" method="post" id="form">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="cs" class="form-label">Numéro Matricule</label>
                        <input type="text" id="cs" name="matricule" class="form-input" value="{{ old('matricule') }}" placeholder="Ex: 123456">
                    </div>

                    <div class="form-group mb-4">
                        <label for="ns" class="form-label">Nom</label>
                        <input type="text" id="ns" name="nom" class="form-input" value="{{ old('nom') }}" placeholder="Nom complet">
                    </div>

                    <button type="submit" class="submit-btn">Ajouter</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("form").addEventListener("submit", function(e) {
            const code = document.getElementById('cs').value.trim();
            const nom = document.getElementById('ns').value.trim();

            if (code === "" || nom === "") {
                e.preventDefault();
                alert("Veuillez remplir tous les champs.");
                return;
            }

            const regex = /^\d{6}$/;
            if (!regex.test(code)) {
                e.preventDefault();
                alert("Le matricule doit contenir exactement 6 chiffres (ex: 123456).");
            }
        });
    </script>

</body>
</html>
