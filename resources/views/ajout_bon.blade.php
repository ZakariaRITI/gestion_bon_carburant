<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Bon</title>
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
            overflow-x: hidden;
        }

        /* Animation de particules simplifiée */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 80%, rgba(14, 165, 233, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(15, 23, 42, 0.05) 0%, transparent 50%);
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

        #menu {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            backdrop-filter: blur(10px);
            background: rgba(15, 23, 42, 0.9);
            border-bottom: 1px solid rgba(14, 165, 233, 0.3);
        }

        /* Container principal */
        .container {
            margin-left: 220px !important;
            margin-top: 80px;
            padding: 2rem;
            max-width: 800px;
        }

        /* Titre principal */
        .main-title {
            color: #ffffff;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        /* Card container */
        .form-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(14, 165, 233, 0.3);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(15, 23, 42, 0.2);
            transition: transform 0.2s ease;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(15, 23, 42, 0.25);
        }

        /* Labels et inputs */
        .form-label {
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control, .form-select {
            background: #ffffff;
            border: 2px solid rgba(14, 165, 233, 0.3);
            border-radius: 8px;
            color: var(--primary-dark);
            padding: 0.4rem 0.6rem;
            margin-bottom: 1rem;
            transition: all 0.2s ease;
            font-size: 0.9rem;
            height: auto;
            width: 100%;
            max-width: 300px;
        }

        .form-control:focus, .form-select:focus {
            background: #ffffff;
            border-color: var(--primary-light);
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
            color: var(--primary-dark);
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(15, 23, 42, 0.5);
            font-size: 0.9rem;
        }

        .form-select option {
            background: #ffffff;
            color: var(--primary-dark);
            padding: 0.5rem;
        }

        /* Input readonly */
        .form-control[readonly] {
            background: #f8f9fa;
            border-color: rgba(14, 165, 233, 0.2);
            color: rgba(15, 23, 42, 0.7);
            cursor: not-allowed;
        }

        /* Bouton submit */
        .btn-submit {
            background: var(--gradient);
            border: none;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.75rem 2rem;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.4);
            background: var(--gradient-reverse);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* Messages d'erreur */
        .text-danger {
            color: #ff6b6b !important;
            font-size: 0.875rem;
            margin-top: -1rem;
            margin-bottom: 1rem;
            font-weight: 500;
            text-shadow: 0 0 10px rgba(255, 107, 107, 0.3);
        }

        /* Form group */
        .form-group {
            margin-bottom: 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-label {
            align-self: flex-start;
            margin-left: calc((100% - 300px) / 2);
        }

        /* Layout responsive */
        @media (max-width: 768px) {
            .container {
                margin-left: 1rem !important;
                margin-right: 1rem !important;
                margin-top: 100px;
                padding: 1rem;
            }

            .form-card {
                padding: 1.5rem;
                max-width: 100%;
            }

            .main-title {
                font-size: 1.5rem;
            }

            .form-control, .form-select {
                max-width: 100%;
            }

            .form-label {
                margin-left: 0;
                align-self: flex-start;
            }
        }

        /* Effet de loading sur le formulaire */
        .form-loading {
            position: relative;
        }

        .form-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(5px);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 24px;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        /* Amélioration visuelle des sélecteurs */
        .form-select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%230ea5e9' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.2em 1.2em;
            padding-right: 2.5rem;
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

    <div class="container">
        <h1 class="main-title">Ajouter un Bon de Carburant</h1>
        
        <div class="form-card">
            <form action="/save" method="get" id="form">
                @csrf
                
                <div class="form-group">
                    <label for="nb" class="form-label">N° Bon</label>
                    <input type="text" id="nb" name="n_bon" class="form-control" required value="{{ old('n_bon') }}" placeholder="Entrez le numéro du bon">
                    @error('n_bon')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tc" class="form-label">Type Carburant</label>
                    <select name="type_carburant" id="tc" class="form-select" required>
                        <option value="">--- Sélectionner le type ---</option>
                        @foreach($carburant as $carb)
                            <option value="{{ $carb->type }}" data-prix="{{ $carb->prix }}" {{ old('type_carburant') == $carb->type ? 'selected' : '' }} >{{ $carb->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="p" class="form-label">Prix (DH)</label>
                    <input type="text" id="p" name="prix" class="form-control" readonly placeholder="Prix automatique" value="{{ old('prix') }}">
                </div>

                <div class="form-group">
                    <label for="q" class="form-label">Quantité (L)</label>
                    <input type="number" step="0.1" class="form-control" name="quantite" id="q" min="0" required placeholder="0.0" value="{{ old('quantite') }}">
                </div>

                <div class="form-group">
                    <label for="db" class="form-label">Date du Bon</label>
                    <input type="date" id="db" name="date_bon" class="form-control" value="{{ old('date_bon') }}" required>
                </div>

                <input type="hidden" id="ds" name="date_saisis" value="">

                <div class="form-group">
                    <label for="s" class="form-label">Site</label>
                    <select name="site" id="s" class="form-select" required>
                        <option value="">--- Sélectionner un site ---</option>
                        @foreach($sites as $s)
                        <option value="{{$s->id}}" {{ old('site') == $s->id ? 'selected' : '' }}>{{$s->nom_site}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="se" class="form-label">Service</label>
                    <select name="service" id="se" class="form-select" required>
                        <option value="">--- Sélectionner un service ---</option>
                        @foreach($services as $se)
                        <option value="{{$se->id}}" {{ old('service') == $se->id ? 'selected' : '' }}>{{$se->nom_service}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nv" class="form-label">N° Véhicule</label>
                    <select name="n_vehicule" id="nv" class="form-select" required>
                        <option value="">--- Sélectionner un véhicule ---</option>
                        @foreach($vehicules as $v)
                        <option value="{{$v->id}}" {{ old('n_vehicule') == $v->id ? 'selected' : '' }}>{{$v->n_vehicule}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="pr" class="form-label">Preneur</label>
                    <select name="preneur" id="pr" class="form-select" required>
                        <option value="">--- Sélectionner un preneur ---</option>
                        @foreach($preneurs as $p)
                        <option value="{{$p->id}}" {{ old('preneur') == $p->id ? 'selected' : '' }}>{{$p->n_matricule}}</option>
                        @endforeach
                    </select>
                </div>

                <input type="hidden" name="user" value="{{Auth::user()->id}}">
                
                <div class="text-center mt-5">
                    <button type="submit" class="btn-submit">
                        Ajouter le Bon
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-remplissage du prix selon le carburant
        document.getElementById('tc').addEventListener('change', function() {
            const prix = this.options[this.selectedIndex].getAttribute('data-prix');
            document.getElementById('p').value = prix || '';
        });

        // Validation du numéro de bon
        document.getElementById('form').addEventListener('submit', function(e) {
            const nb = document.getElementById('nb').value.trim();
            
            if (nb.length !== 6) {
                e.preventDefault();
                alert("Le n° bon doit être composé de 6 chiffres.");
                return;
            }

            // Animation de soumission
            const form = document.querySelector('.form-card');
            form.classList.add('form-loading');
        });

        // Date de saisie automatique
        const today = new Date().toISOString().slice(0, 10);
        document.getElementById('ds').value = today;

        // Animation des inputs au focus (simplifiée)
        document.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.borderColor = '#0ea5e9';
            });
            
            input.addEventListener('blur', function() {
                this.style.borderColor = 'rgba(14, 165, 233, 0.3)';
            });
        });
        
    </script>
</body>
</html>