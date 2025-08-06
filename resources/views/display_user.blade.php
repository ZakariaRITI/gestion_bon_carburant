<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        /* --- Même style que les autres pages (background, card, boutons, table) --- */
        body {
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0; padding: 0;
        }
        #d1 { min-height: 100vh; }
        .main-container { margin-left: 350px; padding: 2rem; }
        @media (max-width:1200px){ .main-container{ margin-left:250px; } }
        @media (max-width:768px){ .main-container{ margin-left:0; padding:1rem; } }

        .sites-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(20px);
            border-radius: 25px;
            border: 1px solid rgba(255,255,255,0.2);
            box-shadow: 0 25px 50px rgba(15,23,42,0.3), 0 0 100px rgba(14,165,233,0.1);
            overflow: hidden; position: relative; margin-top: 4rem;
        }
        .sites-card::before {
            content:''; position:absolute; top:0; left:0; right:0; height:5px;
            background:linear-gradient(90deg,#0f172a 0%, #0ea5e9 50%, #0f172a 100%);
        }
        .card-header {
            background: linear-gradient(135deg,#0f172a 0%, #1e293b 50%, #0ea5e9 100%);
            color:white; padding:2.5rem; text-align:center; position:relative; overflow:hidden;
        }
        .card-header::before {
            content:''; position:absolute; top:0; left:-100%; width:100%; height:100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
            animation: shimmer 4s infinite;
        }
        @keyframes shimmer { 0%{left:-100%} 100%{left:100%} }

        .page-title { font-size:2.5rem; font-weight:700; margin:0; color:white!important; text-shadow:0 2px 20px rgba(0,0,0,0.3); }
        .page-subtitle { font-size:1.05rem; opacity:.9; margin-top:.5rem; color:white!important; }

        .card-body { padding:2.5rem; }

        .custom-alert {
            background: linear-gradient(135deg,#10b981,#059669); color:white; border-radius:15px;
            padding:1rem 1.5rem; margin:1.5rem auto; width:50%; text-align:center; box-shadow:0 10px 30px rgba(16,185,129,0.3);
            animation: slideDown .5s ease-out;
        }
        @keyframes slideDown { from{opacity:0; transform:translateY(-20px)} to{opacity:1; transform:translateY(0)} }

        .add-btn {
            background: linear-gradient(135deg,#0ea5e9,#0284c7); color:white; padding:.75rem 2rem; border-radius:50px; font-weight:600;
            text-decoration:none; display:inline-block; margin:1.5rem 0 2rem 2rem; box-shadow:0 10px 30px rgba(14,165,233,0.3);
            transition:all .3s; position:relative; overflow:hidden;
        }
        .add-btn::after { content:'+ '; margin-right:.5rem; }
        .add-btn:hover { transform:translateY(-3px); box-shadow:0 15px 40px rgba(14,165,233,0.4); }

        .modern-table {
            width:100%; border-collapse:separate; border-spacing:0; background:white; border-radius:20px; overflow:hidden;
            box-shadow:0 15px 40px rgba(15,23,42,0.1); margin:0;
        }
        .modern-table thead { background: linear-gradient(135deg,#0f172a 0%, #1e293b 50%, #0ea5e9 100%); }
        .modern-table thead th {
            color:white; padding:1.2rem 1rem; font-weight:600; text-align:center; font-size:.9rem; text-transform:uppercase;
        }
        .modern-table tbody tr { transition:all .3s ease; background:white; }
        .modern-table tbody tr:nth-child(even) { background: rgba(248,250,252,0.8); }
        .modern-table tbody tr:hover { background: linear-gradient(135deg, rgba(14,165,233,0.06), rgba(15,23,42,0.02)); transform:scale(1.01); box-shadow:0 5px 20px rgba(15,23,42,0.08); }
        .modern-table td { padding:1rem; text-align:center; border-bottom:1px solid rgba(226,232,240,0.8); font-weight:500; color:#334155; }

        .action-btn { padding:.45rem 1rem; border-radius:25px; font-weight:600; font-size:.85rem; display:inline-block; margin:0 .25rem; text-decoration:none; }
        .btn-update { background: linear-gradient(135deg,#f59e0b,#d97706); color:white; box-shadow:0 5px 15px rgba(245,158,11,0.3); }
        .btn-delete { background: linear-gradient(135deg,#ef4444,#dc2626); color:white; box-shadow:0 5px 15px rgba(239,68,68,0.3); }

        .user-id {
            background: linear-gradient(135deg,#0f172a,#0ea5e9); color:white; padding:.4rem .9rem; border-radius:50px; font-weight:600;
            font-family:'Courier New', monospace; display:inline-block; min-width:80px;
        }

        .user-name { font-weight:600; color:#0f172a; position:relative; padding-left:1.5rem; }
        .user-name::before { content:'👤'; position:absolute; left:0; top:50%; transform:translateY(-50%); }

        .fade-in { animation: fadeIn .8s ease-out; }
        @keyframes fadeIn { from{opacity:0; transform:translateY(30px)} to{opacity:1; transform:translateY(0)} }

        .table-row-animate { animation: slideInRow .6s ease-out; opacity:0; transform:translateX(-20px); }
        @keyframes slideInRow { from{opacity:0; transform:translateX(-20px)} to{opacity:1; transform:translateX(0)} }

        .particles { position:fixed; top:0; left:0; width:100%; height:100%; pointer-events:none; z-index:-1; }
        .particle { position:absolute; width:3px; height:3px; background: rgba(14,165,233,0.4); border-radius:50%; animation: particleFloat 20s infinite linear; }
        @keyframes particleFloat {
            0%{ transform:translateY(100vh) translateX(0); opacity:0 }
            10%{ opacity:1 }
            90%{ opacity:1 }
            100%{ transform:translateY(-10px) translateX(50px); opacity:0 }
        }

        @media (max-width:768px){
            .page-title{ font-size:2rem }
            .card-body{ padding:1.5rem }
            .custom-alert{ width:90% }
            .modern-table thead th, .modern-table td { padding:.6rem .4rem; font-size:.8rem }
            .action-btn{ padding:.35rem .6rem; font-size:.75rem }
            .user-id{ padding:.3rem .7rem; font-size:.8rem }
        }
    </style>
</head>
<body>
    <div class="particles" aria-hidden="true">
        <div class="particle" style="left:5%; animation-delay:0s"></div>
        <div class="particle" style="left:15%; animation-delay:3s"></div>
        <div class="particle" style="left:25%; animation-delay:6s"></div>
        <div class="particle" style="left:35%; animation-delay:9s"></div>
        <div class="particle" style="left:45%; animation-delay:12s"></div>
        <div class="particle" style="left:55%; animation-delay:15s"></div>
        <div class="particle" style="left:65%; animation-delay:18s"></div>
        <div class="particle" style="left:75%; animation-delay:21s"></div>
        <div class="particle" style="left:85%; animation-delay:24s"></div>
        <div class="particle" style="left:95%; animation-delay:27s"></div>
    </div>

    <div id="d1">
        <div id="menu1">@include('menu2')</div>

        <div class="main-container">
            <div class="container">
                <div id="menu">@include('menu')</div>

                <div class="sites-card fade-in" role="region" aria-label="Liste des utilisateurs">
                    <div class="card-header">
                        <h1 class="page-title">📍 Liste des Utilisateurs</h1>
                        <p class="page-subtitle">Gère les comptes utilisateurs (nom, email, rôle)</p>
                    </div>

                    <div class="card-body">
                        @if(session('success'))
                        <div class="custom-alert" role="status">✅ {{ session('success') }}</div>
                        @endif

                        <a href="/auser" class="add-btn">Ajouter un nouvel utilisateur</a>

                        <table class="modern-table" aria-describedby="users-table">
                            <thead>
                                <tr>
                                    <th>🆔 Id</th>
                                    <th>👤 Nom</th>
                                    <th>✉️ Email</th>
                                    <th>🔒 Mot de passe</th>
                                    <th>🛠️ Type</th>
                                    <th>✏️ Modifier</th>
                                    <th>🗑️ Supprimer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                <tr class="table-row-animate" style="animation-delay: {{ $index * 0.06 }}s;">
                                    <td><span class="user-id">{{ $user->id }}</span></td>
                                    <td><span class="user-name">{{ $user->name }}</span></td>
                                    <td>{{ $user->email }}</td>
                                    <td>****************</td>
                                    <td>{{ $user->type }}</td>
                                    <td>
                                        <a href="/updateuser?id={{ $user->id }}" class="action-btn btn-update">Modifier</a>
                                    </td>
                                    <td>
                                        <a href="/deleteuser?id={{ $user->id }}" class="action-btn btn-delete delete-link">Supprimer</a>
                                    </td>
                                </tr>
                                @endforeach

                                @if($users->isEmpty())
                                <tr>
                                    <td colspan="7" style="padding:2rem; text-align:center; color:#64748b;">
                                        Aucun utilisateur trouvé.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = document.querySelectorAll('.table-row-animate');
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateX(0)';
                    }
                });
            }, { threshold: 0.1 });
            rows.forEach(r => observer.observe(r));

            // Confirmation suppression
            const deleteLinks = document.querySelectorAll('.delete-link');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userName = this.closest('tr').querySelector('.user-name').textContent.trim();
                    if (confirm(`Êtes-vous sûr de vouloir supprimer l'utilisateur "${userName}" ?`)) {
                        // En dev: redirection GET. En prod: remplace par un formulaire DELETE + CSRF.
                        window.location.href = this.href;
                    }
                });
            });
        });
    </script>
</body>
</html>
