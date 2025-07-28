<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Aide & Support</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/menu.css" />
  <link rel="stylesheet" href="/css/acceuil.css" />
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
    </div> 
    <br><br><br><br>
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
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                  Comment ajouter un véhicule ?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Allez dans la section <strong>Véhicules</strong>, cliquez sur <em>"Ajouter"</em>, remplissez le formulaire et cliquez sur <em>"Valider"</em>.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                  Comment modifier un site ?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Dans la liste des sites, cliquez sur le bouton <strong>"Modifier"</strong> à côté du site concerné.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                  Que faire en cas d'erreur ?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Essayez de rafraîchir la page. Si le problème persiste, contactez-nous via les contacts ci-dessous.
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Section -->
          <h4 class="text-secondary mb-3">📩 Contactez-nous</h4>
          <ul>
            <li>Email : Autohall@example.com</li>
            <li>Téléphone : 05 22 45 67 89</li>
            <li>Assistance disponible du lundi au vendredi, de 9h à 17h</li>
          </ul>

        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
