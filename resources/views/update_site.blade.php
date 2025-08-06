<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier site</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .update-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 8px 30px rgba(2,6,23,0.25);
            border: none;
            color: #0f172a;
        }

        .form-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 0.75rem;
            color: #0f172a;
        }

        .help-text {
            font-size: 0.9rem;
            color: #475569;
        }

        .field-error {
            color: #b91c1c;
            font-size: 0.875rem;
            margin-top: 0.35rem;
        }

        .actions {
            display: flex;
            gap: .75rem;
            align-items: center;
            margin-top: .75rem;
        }

        .btn-warning {
            background-color: #0ea5e9;
            border: none;
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

    <div style="margin-left:250px;">
        <div class="container">
            <div id="menu">
                @include('menu')
            </div>

            <br><br><br><br><br>

            <h1 class="h1 fw-bold text-white">MODIFIER SITE</h1>

            @if(session('error'))
                <div class="alert alert-danger w-50 mx-auto" role="alert">
                    {{ session('error') }}
                </div>
            @endif

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
                            <div class="form-title">Informations du site</div>
                            <p class="help-text">Modifie le code et le nom du site. Les champs marqués d'un astérisque sont obligatoires.</p>

                            <form action="/saveupdate" method="post" id="updateSiteForm" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="cs" class="form-label">Code site <span style="color:#b91c1c;">*</span></label>
                                    <input
                                        type="number"
                                        id="cs"
                                        name="codesite"
                                        class="form-control @error('codesite') is-invalid @enderror"
                                        min="1"
                                        inputmode="numeric"
                                        autocomplete="off"
                                        required
                                        value="{{ old('codesite', optional($site)->code_site) }}"
                                    >
                                    @error('codesite')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ns" class="form-label">Nom site <span style="color:#b91c1c;">*</span></label>
                                    <input
                                        type="text"
                                        id="ns"
                                        name="nomsite"
                                        class="form-control @error('nomsite') is-invalid @enderror"
                                        maxlength="255"
                                        required
                                        value="{{ old('nomsite', optional($site)->nom_site) }}"
                                    >
                                    @error('nomsite')
                                        <div class="field-error">{{ $message }}</div>
                                    @enderror
                                </div>

                                <input type="hidden" name="id" value="{{ optional($site)->id }}">

                                <div class="actions">
                                    <button type="submit" id="submitBtn" class="btn btn-warning w-100 text-white fw-bold">Modifier</button>
                                    <a href="/ds" class="btn-cancel">← Retour</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const form = document.getElementById('updateSiteForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const code = document.getElementById('cs').value.trim();
                const nom  = document.getElementById('ns').value.trim();

                if (!code || !nom) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs obligatoires.');
                    return;
                }

                if (Number(code) < 1) {
                    e.preventDefault();
                    alert('Le code site doit être un entier positif.');
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.textContent = 'Enregistrement...';
            });
        })();
    </script>
</body>
</html>
