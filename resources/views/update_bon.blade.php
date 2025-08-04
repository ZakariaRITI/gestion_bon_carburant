<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Bon</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    body {
        background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
        background: rgba(255, 255, 255, 0.94);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        margin: 20px;
        padding: 0;
        overflow: hidden;
    }

    .header-section {
        background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
        color: white;
        padding: 30px;
        text-align: center;
        position: relative;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.05"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.05"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.05"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    }

    .header-section h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        position: relative;
        z-index: 1;
    }

    .header-icon {
        font-size: 3rem;
        margin-bottom: 15px;
        opacity: 0.9;
    }

    .form-container {
        padding: 40px;
    }

    .form-floating {
        margin-bottom: 1.5rem;
    }

    .form-floating > .form-control,
    .form-floating > .form-select {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    .form-floating > label {
        padding: 1rem 0.75rem;
        font-weight: 500;
        color: #475569;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
    }

    .btn-update {
        background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(14, 165, 233, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(14, 165, 233, 0.5);
        background: linear-gradient(135deg, #0ea5e9 0%, #0f172a 100%);
    }

    .form-row {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
    }

    .form-col {
        flex: 1;
        min-width: 250px;
    }

    .info-card {
        background: linear-gradient(135deg, #f8fafc 0%, #e2f5fb 100%);
        border: 1px solid #e2f5fb;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 30px;
    }

    .info-card h5 {
        color: #0ea5e9;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .alert-custom {
        background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
        border: 1px solid #ffeaa7;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .readonly-field {
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    }

    .date-input {
        height: calc(3.5rem + 2px);
        padding: 1rem 0.75rem;
    }

    @media (max-width: 768px) {
        .main-container {
            margin: 10px;
            border-radius: 15px;
        }

        .form-container {
            padding: 20px;
        }

        .form-row {
            flex-direction: column;
            gap: 0;
        }

        .header-section h1 {
            font-size: 2rem;
        }
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
    
    <div style="margin-left: 200px;">
        <div class="container-fluid">
            <div id="menu">
                @include('menu')
            </div>
            
            <div class="main-container" style="margin-top: 100px;">
                <div class="header-section">
                    <i class="fas fa-gas-pump header-icon"></i>
                    <h1>Modifier Bon de Carburant</h1>
                    <p class="mb-0 opacity-75">Mise à jour des informations du bon</p>
                </div>
                
                <div class="form-container">
                    <form action="/modifier" method="post" id="form">
                        @csrf
                        
                        <!-- Informations du bon -->
                        <div class="info-card">
                            <h5><i class="fas fa-receipt me-2"></i>Informations du Bon</h5>
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-floating">
                                        <input type="text" value="{{$bon->n_bon}}" id="nb" name="n_bon" class="form-control" required placeholder="N° Bon">
                                        <label for="nb"><i class="fas fa-hashtag me-2"></i>N° Bon</label>
                                    </div>
                                    @error('n_bon')
                                    <div class="alert alert-danger" role="alert">
                                        <i class="fas fa-exclamation-triangle me-2"></i>{{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-floating">
                                        <select name="type_carburant" id="tc" class="form-select" required>
                                            <option value="{{$bon->type_carburant}}" data-prix="{{$bon->prix}}">{{$bon->type_carburant}} (valeur enregistrée)</option>
                                            @foreach($carburant as $carb)
                                                <option value="{{ $carb->type }}" data-prix="{{ $carb->prix }}">{{ $carb->type }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tc"><i class="fas fa-oil-can me-2"></i>Type Carburant</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-floating">
                                        <input type="text" value="{{$bon->prix}}" id="p" name="prix" class="form-control readonly-field" readonly placeholder="Prix">
                                        <label for="p"><i class="fas fa-euro-sign me-2"></i>Prix (DH)</label>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-floating">
                                        <input type="number" value="{{$bon->quantite}}" step="0.1" class="form-control" name="quantite" id="q" min="0" required placeholder="Quantité">
                                        <label for="q"><i class="fas fa-tachometer-alt me-2"></i>Quantité (L)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Dates -->
                        <div class="info-card">
                            <h5><i class="fas fa-calendar-alt me-2"></i>Dates</h5>
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-floating">
                                        <input type="date" value="{{$bon->date_bon}}" id="db" name="date_bon" class="form-control date-input" required>
                                        <label for="db"><i class="fas fa-calendar me-2"></i>Date du Bon</label>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-floating">
                                        <input type="date" value="{{$bon->date_saisis}}" id="ds" name="date_saisis" class="form-control date-input" readonly required>
                                        <label for="ds"><i class="fas fa-keyboard me-2"></i>Date de Saisie</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Assignations -->
                        <div class="info-card">
                            <h5><i class="fas fa-users-cog me-2"></i>Assignations</h5>
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-floating">
                                        <select name="site" id="s" class="form-select" required>
                                            <option value="{{$bon->site->id}}">{{$bon->site->nom_site}}</option>
                                            @foreach($sites as $s)
                                            <option value="{{$s->id}}">{{$s->nom_site}}</option>
                                            @endforeach
                                        </select>
                                        <label for="s"><i class="fas fa-map-marker-alt me-2"></i>Site</label>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-floating">
                                        <select name="service" id="se" class="form-select" required>
                                            <option value="{{$bon->service->id}}">{{$bon->service->nom_service}}</option>
                                            @foreach($services as $se)
                                            <option value="{{$se->id}}">{{$se->nom_service}}</option>
                                            @endforeach
                                        </select>
                                        <label for="se"><i class="fas fa-briefcase me-2"></i>Service</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-col">
                                    <div class="form-floating">
                                        <select name="n_vehicule" id="nv" class="form-select" required>
                                            <option value="{{$bon->vehicule->id}}">{{$bon->vehicule->n_vehicule}}</option>
                                            @foreach($vehicules as $v)
                                            <option value="{{$v->id}}">{{$v->n_vehicule}}</option>
                                            @endforeach
                                        </select>
                                        <label for="nv"><i class="fas fa-car me-2"></i>N° Véhicule</label>
                                    </div>
                                </div>
                                
                                <div class="form-col">
                                    <div class="form-floating">
                                        <select name="preneur" id="pr" class="form-select" required>
                                            <option value="{{$bon->preneur->id}}">{{$bon->preneur->n_matricule}}</option>
                                            @foreach($preneurs as $p)
                                            <option value="{{$p->id}}">{{$p->n_matricule}}</option>
                                            @endforeach
                                        </select>
                                        <label for="pr"><i class="fas fa-user me-2"></i>Preneur</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <input type="hidden" name="user" value="{{Auth::user()->id}}">
                        <input type="hidden" name="id" value="{{$bon->id}}">
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-update">
                                <i class="fas fa-save me-2"></i>Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tc').addEventListener('change', function() {
    const prix = this.options[this.selectedIndex].getAttribute('data-prix');
    document.getElementById('p').value = prix || '';
});

document.getElementById('form').addEventListener('submit', function(e) {
    const nb = document.getElementById('nb').value.trim();
    const regexSixChiffres = /^\d{6}$/;

    // Supprimer les anciens messages d'erreur affichés
    const oldAlert = document.querySelector('.alert-danger');
    if (oldAlert) {
        oldAlert.remove();
    }

    if (!regexSixChiffres.test(nb)) {
        e.preventDefault();

        const alertDiv = document.createElement('div');
        alertDiv.className = 'alert alert-danger alert-dismissible fade show';
        alertDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erreur :</strong> Le n° bon doit être composé de 6 chiffres.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;

        const formContainer = document.querySelector('.form-container');
        const form = formContainer.querySelector('form');
        formContainer.insertBefore(alertDiv, form);

        const offset = alertDiv.getBoundingClientRect().top + window.pageYOffset - 100;
        window.scrollTo({ top: offset, behavior: 'smooth' });

        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>