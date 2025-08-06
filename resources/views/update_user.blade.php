<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Modifier User</title>
  <link rel="stylesheet" href="/css/menu.css" />
  <link rel="stylesheet" href="/css/acceuil.css" />
  <style>
    body {
      margin: 0;
      min-height: 100vh;
      background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
      font-family: Arial, sans-serif;
      color: #fff;
    }
    .update-card {
      background: rgba(255, 255, 255, 0.97);
      border-radius: 12px;
      padding: 1.6rem;
      box-shadow: 0 10px 30px rgba(2, 6, 23, 0.25);
      color: #0f172a;
    }
    .form-title {
      font-weight: 700;
      font-size: 1.25rem;
      margin-bottom: 0.4rem;
    }
    .help-text {
      font-size: 0.9rem;
      color: #475569;
      margin-bottom: 0.6rem;
    }
    .field-error {
      color: #b91c1c;
      font-size: 0.875rem;
      margin-top: 0.35rem;
    }
    .actions {
      display: flex;
      gap: 0.75rem;
      align-items: center;
      margin-top: 0.75rem;
    }
    .btn-warning {
      background: #0ea5e9;
      border: none;
      color: #fff;
    }
    .btn-warning:hover {
      background: #0284c7;
    }
    .btn-cancel {
      background: transparent;
      border: 1px solid #0ea5e9;
      color: #0ea5e9;
      padding: 0.45rem 0.9rem;
      border-radius: 8px;
      text-decoration: none;
      transition: all 0.15s ease;
    }
    .btn-cancel:hover {
      background: #0ea5e9;
      color: #fff;
    }
    @media (max-width: 768px) {
      .update-card {
        padding: 1rem;
      }
      .form-title {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>
  <div id="menu1">
    @include('menu2')
  </div>

  <div style="margin-left:250px; margin-bottom:200px;">
    <div class="container">
      <div id="menu">
        @include('menu')
      </div>

      <br /><br /><br /><br /><br />

      <h1 class="h1 fw-bold text-white">MODIFIER USER</h1>

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
              <div class="form-title">Informations utilisateur</div>

              <form action="/saveupdateuser" method="post" id="updateUserForm" novalidate>
                @csrf
                <input type="text" name="fake_username" style="display:none" autocomplete="off" />
                
                <div class="mb-3">
                  <label for="cs" class="form-label">Nom <span style="color:#b91c1c;">*</span></label>
                  <input
                    type="text"
                    id="cs"
                    name="user_nom"
                    class="form-control @error('user_nom') is-invalid @enderror"
                    value="{{ old('user_nom', optional($user)->name) }}"
                    required
                    maxlength="255"
                  />
                  @error('user_nom')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="ns" class="form-label">Email <span style="color:#b91c1c;">*</span></label>
                  <input
                    type="email"
                    id="ns"
                    name="user_email"
                    class="form-control @error('user_email') is-invalid @enderror"
                    value="{{ old('user_email', optional($user)->email) }}"
                    required
                  />
                  @error('user_email')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="p" class="form-label">Password <small class="text-muted">(laisser vide si pas de changement)</small></label>
                  <input
                    type="password"
                    id="p"
                    name="pwd"
                    class="form-control @error('pwd') is-invalid @enderror"
                    placeholder="Nouveau mot de passe"
                  />
                  @error('pwd')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                </div>

                <div class="mb-3">
                  <label for="type" class="form-label">Type <span style="color:#b91c1c;">*</span></label>
                  <select
                    id="type"
                    name="type"
                    class="form-control @error('type') is-invalid @enderror"
                    required
                  >
                    <option value="">-- Sélectionnez un type --</option>
                    <option value="admin" {{ old('type', optional($user)->type) == 'admin' ? 'selected' : '' }}>
                      Admin
                    </option>
                    <option value="user" {{ old('type', optional($user)->type) == 'user' ? 'selected' : '' }}>
                      User
                    </option>
                  </select>
                  @error('type')
                    <div class="field-error">{{ $message }}</div>
                  @enderror
                  <small class="text-muted">Type actuel : {{ optional($user)->type }}</small>
                </div>

                <input type="hidden" name="id" value="{{ optional($user)->id }}" />

                <div class="actions">
                  <button type="submit" class="btn btn-warning w-100" id="submitBtn">Modifier</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (() => {
      const form = document.getElementById('updateUserForm');
      const submitBtn = document.getElementById('submitBtn');

      form.addEventListener('submit', e => {
        const nom = document.getElementById('cs').value.trim();
        const email = document.getElementById('ns').value.trim();
        const pwd = document.getElementById('p').value.trim();
        const type = document.getElementById('type').value;

        if (!nom || !email || !type) {
          e.preventDefault();
          alert('Veuillez remplir tous les champs obligatoires.');
          return;
        }

        // Validation email basique
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
          e.preventDefault();
          alert('Veuillez entrer une adresse email valide.');
          return;
        }

        // Disable submit button to prevent double submission
        submitBtn.disabled = true;
        submitBtn.textContent = 'Enregistrement...';
      });

      // Reactivate submit if form is modified
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
