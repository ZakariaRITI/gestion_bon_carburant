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
    body {
      background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Évite que le menu affecte le contenu */
    .support-wrapper {
      margin-left: 220px;
      padding: 2rem;
    }

    @media (max-width: 768px) {
      .support-wrapper {
        margin-left: 0;
        padding: 1rem;
      }
    }

    .main-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 20px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      box-shadow: 
        0 20px 40px rgba(15, 23, 42, 0.3),
        0 0 80px rgba(14, 165, 233, 0.1);
      overflow: hidden;
      position: relative;
    }

    .main-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #0f172a 0%, #0ea5e9 50%, #0f172a 100%);
    }

    .card-header-custom {
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0ea5e9 100%);
      color: white;
      padding: 2rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .card-header-custom::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
      0% { left: -100%; }
      100% { left: 100%; }
    }

    .main-title {
      font-size: 2.5rem;
      font-weight: 700;
      margin: 0;
      text-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
      position: relative;
      z-index: 1;
    }

    .main-subtitle {
      font-size: 1.1rem;
      opacity: 0.9;
      margin-top: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .section-title {
      color: #0f172a;
      font-weight: 600;
      font-size: 1.5rem;
      margin-bottom: 1.5rem;
      position: relative;
      padding-left: 3rem;
    }

    .section-title::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 2rem;
      height: 3px;
      background: linear-gradient(90deg, #0f172a, #0ea5e9);
      border-radius: 2px;
    }

    .accordion-custom .accordion-item {
      border: none;
      margin-bottom: 1rem;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(15, 23, 42, 0.08);
      transition: all 0.3s ease;
    }

    .accordion-custom .accordion-item:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);
    }

    .accordion-custom .accordion-button {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      border: none;
      color: #0f172a;
      font-weight: 600;
      padding: 1.25rem 1.5rem;
      position: relative;
      transition: all 0.3s ease;
    }

    .accordion-custom .accordion-button:not(.collapsed) {
      background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
      color: white;
      box-shadow: none;
    }

    .accordion-custom .accordion-button:focus {
      box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
    }

    .accordion-custom .accordion-button::after {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230f172a'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
      transition: transform 0.3s ease;
    }

    .accordion-custom .accordion-button:not(.collapsed)::after {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-custom .accordion-body {
      background: white;
      padding: 1.5rem;
      color: #475569;
      line-height: 1.6;
      border-top: 2px solid #f1f5f9;
    }

    .contact-card {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      border-radius: 15px;
      padding: 2rem;
      border: 1px solid rgba(14, 165, 233, 0.1);
      position: relative;
      overflow: hidden;
    }

    .contact-card::before {
      content: '';
      position: absolute;
      top: 0;
      right: 0;
      width: 100px;
      height: 100px;
      background: radial-gradient(circle, rgba(14, 165, 233, 0.1) 0%, transparent 70%);
    }

    .contact-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .contact-list li {
      background: white;
      margin-bottom: 1rem;
      padding: 1rem 1.5rem;
      border-radius: 10px;
      border-left: 4px solid #0ea5e9;
      box-shadow: 0 2px 10px rgba(15, 23, 42, 0.05);
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
    }

    .contact-list li:hover {
      transform: translateX(5px);
      box-shadow: 0 5px 20px rgba(15, 23, 42, 0.1);
    }

    .contact-list li::before {
      content: '📧';
      margin-right: 1rem;
      font-size: 1.2rem;
    }

    .contact-list li:nth-child(2)::before {
      content: '📞';
    }

    .contact-list li:nth-child(3)::before {
      content: '🕐';
    }

    .card-body-custom {
      padding: 2.5rem;
    }

    /* Animations */
    .fade-in {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .float-animation {
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-10px); }
    }

    /* Effets de particules */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      overflow: hidden;
    }

    .particle {
      position: absolute;
      width: 4px;
      height: 4px;
      background: rgba(14, 165, 233, 0.6);
      border-radius: 50%;
      animation: particle-float 15s infinite linear;
    }

    @keyframes particle-float {
      0% {
        transform: translateY(100vh) translateX(0px);
        opacity: 0;
      }
      10% {
        opacity: 1;
      }
      90% {
        opacity: 1;
      }
      100% {
        transform: translateY(-10px) translateX(100px);
        opacity: 0;
      }
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-title {
        font-size: 2rem;
      }
      
      .card-body-custom {
        padding: 1.5rem;
      }
      
      .contact-list li {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <div class="particles">
    <div class="particle" style="left: 10%; animation-delay: 0s;"></div>
    <div class="particle" style="left: 20%; animation-delay: 2s;"></div>
    <div class="particle" style="left: 30%; animation-delay: 4s;"></div>
    <div class="particle" style="left: 40%; animation-delay: 6s;"></div>
    <div class="particle" style="left: 50%; animation-delay: 8s;"></div>
    <div class="particle" style="left: 60%; animation-delay: 10s;"></div>
    <div class="particle" style="left: 70%; animation-delay: 12s;"></div>
    <div class="particle" style="left: 80%; animation-delay: 14s;"></div>
    <div class="particle" style="left: 90%; animation-delay: 16s;"></div>
  </div>

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
      <div class="main-card fade-in float-animation">
        <div class="card-header-custom">
          <h1 class="main-title">🛠️ Aide & Support</h1>
          <p class="main-subtitle">Nous sommes là pour vous aider à tirer le meilleur parti de votre expérience</p>
        </div>
        
        <div class="card-body-custom">
          <!-- FAQ Section -->
          <h4 class="section-title">❓ Foire Aux Questions (FAQ)</h4>
          <div class="accordion accordion-custom mb-5" id="faqAccordion">
            <div class="accordion-item">  
              <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                  Comment ajouter un véhicule ?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Allez dans la section <strong>Véhicules</strong>, cliquez sur <em>"Ajouter"</em>, remplissez le formulaire avec les informations requises et cliquez sur <em>"Valider"</em>. Assurez-vous que toutes les informations obligatoires sont correctement saisies.
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
                  Dans la liste des sites, cliquez sur le bouton <strong>"Modifier"</strong> à côté du site concerné. Vous pourrez alors modifier les informations du site et sauvegarder vos modifications.
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
                  Essayez d'abord de rafraîchir la page (F5). Si le problème persiste, vérifiez votre connexion internet et contactez-nous via les moyens de contact ci-dessous en précisant l'erreur rencontrée.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                  Comment gérer les utilisateurs ?
                </button>
              </h2>
              <div id="faq4" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  Accédez au menu <strong>"Gestion des utilisateurs"</strong> pour ajouter, modifier ou supprimer des comptes utilisateur. Seuls les administrateurs peuvent effectuer ces actions.
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Section -->
          <h4 class="section-title">📩 Contactez-nous</h4>
          <div class="contact-card">
            <ul class="contact-list">
              <li><strong>Email :</strong> Autohall@example.com</li>
              <li><strong>Téléphone :</strong> 05 22 45 67 89</li>
              <li><strong>Horaires :</strong> Assistance disponible du lundi au vendredi, de 9h à 17h</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>