<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aide & Support</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/css/menu.css">
  <link rel="stylesheet" href="/css/acceuil.css">
  <style>
    /* Évite que le menu affecte le contenu */
    .support-wrapper {
      margin-left: 220px; /* ajuste si ton menu est fixe sur le côté */
      padding: 2rem;
    }

    @media (max-width: 768px) {
      .support-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
    }
  </style>
</head>
<body class="bg-light">
  <div id="menu1">
    @include('menu2')
  </div>  
  <div class="container">
        <div id="menu">
            @include('menu')
        </div> <br> <br> <br> <br>
  </div>
  <div class="support-wrapper">
    <div class="container">
      <div class="card shadow-lg border-0">
        <div class="card-body">
          <h2 class="card-title text-center text-primary mb-4">🛠️ Aide & Support</h2>

          <!-- FAQ Section -->
          <h4 class="text-secondary mb-3">❓ Foire Aux Questions (FAQ)</h4>
          <div class="accordion mb-4" id="faqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  Comment ajouter un véhicule ?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Allez dans la section <strong>Véhicules</strong>, cliquez sur <em>"Ajouter"</em>, remplissez le formulaire et cliquez sur <em>"Valider"</em>.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                  Comment modifier un site ?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Dans la liste des sites, cliquez sur le bouton <strong>"Modifier"</strong> à côté du site concerné.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                  Que faire en cas d'erreur ?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Essayez de rafraîchir la page. Si le problème persiste, contactez-nous via le formulaire ci-dessous.
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Section -->
          <h4 class="text-secondary mb-3">📩 Contactez-nous</h4>
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Nom</label>
              <input type="text" class="form-control" id="name" placeholder="Votre nom">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Adresse e-mail</label>
              <input type="email" class="form-control" id="email" placeholder="exemple@mail.com">
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="4" placeholder="Décrivez votre problème ici..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer</button>
          </form>

          <p class="text-muted mt-4 mb-0 text-center">
            📞 Assistance disponible du lundi au vendredi, de 9h à 17h.
          </p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
