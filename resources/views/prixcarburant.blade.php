<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prix carburant</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        /* Variables CSS pour les couleurs */
        :root {
            --primary-dark: #0f172a;
            --primary-light: #0ea5e9;
            --gradient: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            --gradient-reverse: linear-gradient(135deg, #0ea5e9 0%, #0f172a 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: var(--gradient);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        /* Effet d'arrière-plan subtil */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 25% 75%, rgba(14, 165, 233, 0.08) 0%, transparent 50%),
                radial-gradient(circle at 75% 25%, rgba(15, 23, 42, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: -1;
        }

        /* Styles pour les menus (préservés pour le backend) */
        #d1 {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        /* Titre principal */
        .main-title {
            color: #ffffff;
            text-align: center;
            font-size: 2.2rem;
            font-weight: 700;
            margin-top: 140px;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Container centré */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh;
            padding: 1rem;
            margin-left: 300px;
        }

        /* Card du formulaire */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(14, 165, 233, 0.3);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(15, 23, 42, 0.25);
            width: 100%;
            max-width: 400px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .form-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(15, 23, 42, 0.35);
        }

        /* Labels */
        .form-label {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            display: block;
            width: 100%;
        }

        /* Inputs */
        .form-control {
            background: #ffffff;
            border: 2px solid rgba(14, 165, 233, 0.3);
            border-radius: 8px;
            color: var(--primary-dark);
            padding: 0.6rem 0.8rem;
            transition: all 0.2s ease;
            font-size: 1rem;
            width: 100%;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.15);
            color: var(--primary-dark);
            outline: none;
        }

        .form-control:hover {
            border-color: var(--primary-light);
        }

        /* Bouton submit */
        .btn-submit {
            background: var(--gradient);
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 0.8rem 2rem;
            width: 100%;
            transition: all 0.2s ease;
            box-shadow: 0 6px 20px rgba(15, 23, 42, 0.3);
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(15, 23, 42, 0.4);
            background: var(--gradient-reverse);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.3);
        }

        /* Groupes de champs */
        .input-group {
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
        }

        .input-group:last-of-type {
            margin-bottom: 2rem;
        }

        /* Icons pour les carburants */
        .fuel-icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .essence-icon {
            background: linear-gradient(45deg, var(--primary-light), #22d3ee);
            border-radius: 50%;
        }

        .diesel-icon {
            background: linear-gradient(45deg, var(--primary-dark), #374151);
            border-radius: 50%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-title {
                font-size: 1.8rem;
                margin-top: 120px;
            }

            .form-card {
                padding: 2rem;
                margin: 1rem;
                max-width: 350px;
            }

            .container {
                padding: 1rem;
                min-height: 50vh;
            }
        }

        @media (max-width: 480px) {
            .form-card {
                padding: 1.5rem;
                max-width: 300px;
            }

            .main-title {
                font-size: 1.5rem;
            }
        }

        /* Animation de chargement subtile */
        .form-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Effet focus sur les labels */
        .input-group:focus-within .form-label {
            color: var(--primary-light);
            transition: color 0.2s ease;
        }
    </style>
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
    <div id="menu">
        @include('menu')
    </div>

    <h1 class="main-title">Prix Carburant</h1>
    
    <div class="container">
        <form action="/pcs" method="get" class="form-card">
            <label for="e" class="form-label">Essence:</label><br>
            <input type="number" id="e" name="essence" value="{{ $carb[0] }}" class="form-control" min="0" step="0.01"><br>
            
            <label for="d" class="form-label">Diesel:</label><br>
            <input type="number" id="d" name="diesel" value="{{ $carb[1] }}" class="form-control" min="0" step="0.01"><br><br>
            
            <input type="submit" value="changer" class="btn-submit">
        </form>
    </div>

    <script>
        // Animation au focus des inputs
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Validation simple côté client
        document.querySelector('form').addEventListener('submit', function(e) {
            const essence = document.getElementById('e').value;
            const diesel = document.getElementById('d').value;
            
            if (!essence || !diesel) {
                e.preventDefault();
                alert('Veuillez saisir les prix pour l\'essence et le diesel.');
                return;
            }
            
            if (parseFloat(essence) < 0 || parseFloat(diesel) < 0) {
                e.preventDefault();
                alert('Les prix ne peuvent pas être négatifs.');
                return;
            }
        });
    </script>
</body>
</html>