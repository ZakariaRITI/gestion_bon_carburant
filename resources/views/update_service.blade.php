<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier service</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        /* Fond dégradé principal */
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            color: #fff;
            font-family: Arial, sans-serif;
        }

        /* Carte blanche pour le formulaire */
        .update-card {
            background: rgba(255,255,255,0.97);
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 10px 30px rgba(2,6,23,0.25);
            border: none;
            color: #0f172a;
        }

        .form-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            color: #0f172a;
        }

        .help-text {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 0.75rem;
        }

        .field-error {
            color: #b91c1c;
            font-size: 0.875rem;
            margin-top: 0.35rem;
        }

        .actions {
            display:flex;
            gap: .75rem;
            align-items:center;
            margin-top: .75rem;
        }

        .btn-warning {
            background-color: #0ea5e9;
            border: none;
            color: #fff;
        }

        .btn-warning:hover {
            background-color: #0284c7;
        }

        .btn-cancel {
            background: transparent;
            border: 1px solid #0ea5e9;
            color: #0ea5e9;
            padding: .45rem .9rem;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-cancel:hover {
            background: #0ea5e9;
            color: #fff;
        }

        /* responsive */
        @media (max-width: 768px) {
            .update-card { padding: 1rem; }
            .form-title { font-size: 1.2rem; }
        }
    </style>
</head>
<body>
    <div id="menu1">
        @include('menu2')
    </div>

    <!-- conserver la marge gauche comme sur tes autres vues -->
    <div style="margin-left:250px;">
        <div class="container">
            <div id="menu">
                @include('menu')
            </div>

            <br><br><br><br><br>

            <h1 class="h1 fw-bold text-white">MODIFIER SERVICE</h1>

            {{-- message d'erreur en session (ex: code déjà utilisé) --}}
            @if(session('error'))
                <div class="alert alert-danger w-50 mx-auto" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- erreurs de validation Laravel --}}
            @if ($errors->any())
                <div class="alert alert-danger w-75 mx-auto" role="alert">
                    <strong>Erreur(s) :</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="update-card">
                            <div class="form-title">Informations du service</div>
                            <p class="help-text">Le code service doit contenir exactement <strong>2 caractères</strong>. Les champs marqués d'un astérisque sont obligatoires.</p>

                            <!-- On garde l'action actuelle et le CSRF comme demandé -->
                            <form action="/saveupdateservice" method="post" id="updateServiceForm" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="cs" class="form-label">Code service <span style="color:#b91c1c;">*</span></label>
                                    <input
                                        type="text"
                                        id="cs"
                                        name="codeservice"
                                        class="form-control @error('codeservice') is-invalid @enderror"
                                        maxlength="2"
                                        minlength="2"
                                        required
                                        autocomplete="off"
                                        value="{{ old('codeservice', optional($service)->code_service) }}"
                                        aria-describedby="csHelp"
                                    >
                                    <div id="csHelp" class="help-text">Ex : <code>HR</code>, <code>IT</code> — exactement 2 caractères.</div>
                                    @error('codeservice')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ns" class="form-label">Nom service <span style="color:#b91c1c;">*</span></label>
                                    <input
                                        type="text"
                                        id="ns"
                                        name="nomservice"
                                        class="form-control @error('nomservice') is-invalid @enderror"
                                        maxlength="255"
                                        required
                                        value="{{ old('nomservice', optional($service)->nom_service) }}"
                                    >
                                    @error('nomservice')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="id" value="{{ optional($service)->id }}">

                                <div class="actions">
                                    <button type="submit" id="submitBtn" class="btn btn-warning w-100">Modifier</button>
                                    <a href="/ds" class="btn-cancel">← Retour</a>
                                </div>
                            </form>
                        </div> <!-- update-card -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        /* Validation client + prevention double-submit + vérification code = 2 caractères */
        (function() {
            const form = document.getElementById('updateServiceForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const code = document.getElementById('cs').value.trim();
                const nom  = document.getElementById('ns').value.trim();

                // champs obligatoires
                if (!code || !nom) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }

                // code exactement 2 caractères
                if (code.length !== 2) {
                    e.preventDefault();
                    alert('Le code service doit avoir exactement 2 caractères.');
                    return;
                }

                // optionnel : forcer uppercase
                document.getElementById('cs').value = code.toUpperCase();

                // disable submit pour éviter double envoi
                submitBtn.disabled = true;
                submitBtn.textContent = 'Enregistrement...';
            });

            // réactiver le bouton quand l'utilisateur modifie un champ
            ['input', 'change'].forEach(evt =>
                form.addEventListener(evt, () => {
                    if (submitBtn.disabled) {
                        submitBtn.disabled = false;
                        submitBtn.textContent = 'Modifier';
                    }
                })
            );
        })();
    </script>
</body>
</html>
