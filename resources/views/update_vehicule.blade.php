<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier véhicule</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            font-family: Arial, sans-serif;
        }

        .update-card {
            background: rgba(255,255,255,0.97);
            border-radius: 12px;
            padding: 1.75rem;
            box-shadow: 0 10px 30px rgba(2,6,23,0.25);
            color: #0f172a;
        }

        .form-title {
            font-weight: 700;
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
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
            display: flex;
            gap: .75rem;
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

            <h1 class="h1 fw-bold text-white">MODIFIER VÉHICULE</h1>

            @if(session('error'))
                <div class="alert alert-danger w-50 mx-auto">
                    {{ session('error') }}
                </div>
            @endif

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="update-card">
                            <div class="form-title">Informations du véhicule</div>
                            <p class="help-text">Format du numéro : <strong>0000-X0</strong> (7 caractères)</p>

                            <form action="/saveupdatevehicule" method="post" id="updateVehiculeForm" novalidate>
                                @csrf

                                <div class="mb-3">
                                    <label for="cs" class="form-label">Numéro véhicule <span style="color:#b91c1c;">*</span></label>
                                    <input type="text" id="cs" name="codevehicule"
                                           class="form-control"
                                           maxlength="7"
                                           value="{{ old('codevehicule', $vehicule->n_vehicule) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="ns" class="form-label">Marque <span style="color:#b91c1c;">*</span></label>
                                    <input type="text" id="ns" name="marque"
                                           class="form-control"
                                           value="{{ old('marque', $vehicule->marque) }}">
                                </div>

                                <div class="mb-3">
                                    <label for="m" class="form-label">Modèle <span style="color:#b91c1c;">*</span></label>
                                    <input type="text" id="m" name="modele"
                                           class="form-control"
                                           value="{{ old('modele', $vehicule->modele) }}">
                                </div>

                                <input type="hidden" name="id" value="{{ $vehicule->id }}">

                                <div class="actions">
                                    <button type="submit" class="btn btn-warning w-100">Modifier</button>
                                    <a href="/gvehicule" class="btn-cancel">← Retour</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("updateVehiculeForm").addEventListener("submit", function(e) {
            let code = document.getElementById('cs').value.trim();
            let marque = document.getElementById('ns').value.trim();
            let modele = document.getElementById('m').value.trim();

            if (!code || !marque || !modele) {
                e.preventDefault();
                alert("Veuillez remplir tous les champs.");
                return;
            }

            // Vérification du format 0000-X0
            let regex = /^[0-9]{4}-[A-Z]{1}[0-9]{1}$/;

            if (!regex.test(code.toUpperCase())) {
                e.preventDefault();
                alert("Le numéro véhicule doit respecter le format : 0000-X0");
                return;
            }

            document.getElementById('cs').value = code.toUpperCase();
        });
    </script>
</body>
</html>
