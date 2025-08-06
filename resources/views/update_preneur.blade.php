<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Modifier Preneur</title>
  <link rel="stylesheet" href="/css/menu.css">
  <link rel="stylesheet" href="/css/acceuil.css">
  <style>
    body{
      margin:0;
      min-height:100vh;
      background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
      font-family: Arial, sans-serif;
      color: #fff;
    }

    .update-card{
      background: rgba(255,255,255,0.97);
      border-radius:12px;
      padding:1.6rem;
      box-shadow: 0 10px 30px rgba(2,6,23,0.25);
      color: #0f172a;
    }

    .form-title{
      font-weight:700;
      font-size:1.25rem;
      margin-bottom:.4rem;
    }

    .help-text{ font-size:0.9rem; color:#475569; margin-bottom:.6rem; }

    .field-error{ color:#b91c1c; font-size:.875rem; margin-top:.35rem; }

    .actions{ display:flex; gap:.75rem; align-items:center; margin-top:.75rem; }

    .btn-warning{ background:#0ea5e9; border:none; color:#fff; }
    .btn-warning:hover{ background:#0284c7; }

    .btn-cancel{
      background:transparent;
      border:1px solid #0ea5e9;
      color:#0ea5e9;
      padding:.45rem .9rem;
      border-radius:8px;
      text-decoration:none;
      transition:all .15s ease;
    }
    .btn-cancel:hover{ background:#0ea5e9; color:#fff; }

    @media (max-width:768px){
      .update-card{ padding:1rem; }
      .form-title{ font-size:1.1rem; }
    }
  </style>
</head>
<body>
  <div id="menu1">
    @include('menu2')
  </div>

  <!-- garder la même marge que tes autres vues -->
  <div style="margin-left:250px;">
    <div class="container">
      <div id="menu">
        @include('menu')
      </div>

      <br><br><br><br><br>

      <h1 class="h1 fw-bold text-white">MODIFIER PRENEUR</h1>

      {{-- message d'erreur en session --}}
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
              <div class="form-title">Informations du preneur</div>
              <p class="help-text">Le matricule doit contenir exactement <strong>6 chiffres</strong> (ex: 123456).</p>

              <form action="/saveupdatepreneur" method="post" id="updatePreneurForm" novalidate>
                @csrf

                <div class="mb-3">
                  <label for="cs" class="form-label">Matricule <span style="color:#b91c1c;">*</span></label>
                  <input
                    type="text"
                    id="cs"
                    name="matricule"
                    class="form-control @error('matricule') is-invalid @enderror"
                    maxlength="6"
                    inputmode="numeric"
                    autocomplete="off"
                    required
                    value="{{ old('matricule', optional($preneur)->n_matricule) }}"
                    aria-describedby="csHelp"
                  />
                  <div id="csHelp" class="help-text">6 chiffres seulement.</div>
                  @error('matricule')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="ns" class="form-label">Nom <span style="color:#b91c1c;">*</span></label>
                  <input
                    type="text"
                    id="ns"
                    name="nom"
                    class="form-control @error('nom') is-invalid @enderror"
                    maxlength="255"
                    required
                    value="{{ old('nom', optional($preneur)->nom) }}"
                  />
                  @error('nom')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                </div>

                <input type="hidden" name="id" value="{{ optional($preneur)->id }}">

                <div class="actions">
                  <button type="submit" id="submitBtn" class="btn btn-warning w-100">Modifier</button>
                  <a href="/gpreneur" class="btn-cancel">← Retour</a>
                </div>
              </form>

            </div> <!-- update-card -->
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function(){
      const form = document.getElementById('updatePreneurForm');
      const submitBtn = document.getElementById('submitBtn');

      form.addEventListener('submit', function(e){
        const code = document.getElementById('cs').value.trim();
        const nom  = document.getElementById('ns').value.trim();

        if(!code || !nom){
          e.preventDefault();
          alert('Veuillez remplir tous les champs obligatoires.');
          return;
        }

        const regex = /^\d{6}$/;
        if(!regex.test(code)){
          e.preventDefault();
          alert('Le matricule doit contenir exactement 6 chiffres (ex : 123456).');
          return;
        }

        // disable submit to avoid double submit
        submitBtn.disabled = true;
        submitBtn.textContent = 'Enregistrement...';
      });

      // réactive le bouton si l'utilisateur modifie le formulaire
      ['input','change'].forEach(evt =>
        form.addEventListener(evt, () => {
          if(submitBtn.disabled){
            submitBtn.disabled = false;
            submitBtn.textContent = 'Modifier';
          }
        })
      );
    })();
  </script>
</body>
</html>
