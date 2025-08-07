<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Service</title>
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/acceuil.css">
    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-container {
            min-height: 100vh;
            padding: 80px 0 40px 0;
        }

        .page-title {
            color: #ffffff;
            font-size: 2.8rem;
            font-weight: 700;
            text-align: center;
            margin: 0 0 50px 0;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            letter-spacing: 1px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.1);
            padding: 50px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .form-card:hover {
            transform: translateY(-8px);
            box-shadow: 
                0 35px 70px rgba(0, 0, 0, 0.2),
                0 0 0 1px rgba(255, 255, 255, 0.15);
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #0f172a 0%, #0ea5e9 100%);
        }

        .form-group {
            margin-bottom: 30px;
            position: relative;
        }

        .form-label {
            display: block;
            color: #1e293b;
            font-weight: 600;
            margin-bottom: 12px;
            font-size: 15px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .form-input {
            width: 100%;
            padding: 20px 24px;
            border: 2px solid #e2e8f0;
            border-radius: 15px;
            font-size: 16px;
            background: #ffffff;
            transition: all 0.3s ease;
            box-sizing: border-box;
            font-family: inherit;
            color: #1e293b;
        }

        .form-input:focus {
            outline: none;
            border-color: #0ea5e9;
            box-shadow: 0 0 0 6px rgba(14, 165, 233, 0.1);
            transform: translateY(-2px);
        }

        .form-input:hover {
            border-color: #64748b;
            transform: translateY(-1px);
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #0f172a 0%, #0ea5e9 100%);
            color: white;
            border: none;
            padding: 22px;
            border-radius: 15px;
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(14, 165, 233, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin: 20px auto;
            max-width: 500px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: linear-gradient(135deg, #10b981, #34d399);
            color: white;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ef4444, #f87171);
            color: white;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .geometric-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            opacity: 0.1;
        }

        .geometric-shape {
            position: absolute;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .shape-1 {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            top: 10%;
            right: 15%;
            animation: rotate 20s linear infinite;
        }

        .shape-2 {
            width: 150px;
            height: 150px;
            top: 70%;
            left: 10%;
            transform: rotate(45deg);
            animation: pulse 4s ease-in-out infinite;
        }

        .shape-3 {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            bottom: 15%;
            right: 20%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { transform: rotate(45deg) scale(1); }
            50% { transform: rotate(45deg) scale(1.1); }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        @media (max-width: 768px) {
            .main-container {
                padding: 60px 0 30px 0;
            }
            .page-title {
                font-size: 2.2rem;
                margin-bottom: 30px;
            }
            .form-card {
                padding: 40px 30px;
                margin: 0 20px;
            }
            .form-input {
                padding: 18px 20px;
            }
            .submit-btn {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="geometric-bg">
        <div class="geometric-shape shape-1"></div>
        <div class="geometric-shape shape-2"></div>
        <div class="geometric-shape shape-3"></div>
    </div>

    <div id="menu1">@include('menu2')</div>

    <div class="main-container">
        <div id="menu">@include('menu')</div>

        <h1 class="page-title">AJOUT SERVICE</h1>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <div class="form-container">
            <div class="form-card">
                <form action="/ajservice" method="post" id="form">
                    @csrf
                    <div class="form-group">
                        <label for="cs" class="form-label">Code service</label>
                        <input type="text" 
                               id="cs" 
                               name="codeservice" 
                               class="form-input" 
                               maxlength="2"
                               value="{{ old('codeservice') }}"
                               placeholder="Entrez le code du service">
                    </div>
                    
                    <div class="form-group">
                        <label for="ns" class="form-label">Nom service</label>
                        <input type="text" 
                               id="ns" 
                               name="nomservice" 
                               class="form-input" 
                               value="{{ old('nomservice') }}"
                               placeholder="Entrez le nom du service">
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        Ajouter le Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("form").addEventListener("submit", function(e) {
    const code = document.getElementById('cs').value.trim();
    const nom = document.getElementById('ns').value.trim();
    const alphaRegex = /^[A-Za-z]{2}$/; // Seulement 2 lettres alphabétiques

    if (code === "" || nom === "") {  
        e.preventDefault();
        this.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            this.style.animation = '';
            alert("Veuillez remplir tous les champs");
        }, 500);
    } else if (!alphaRegex.test(code)) {
        e.preventDefault();
        alert("Le code service doit contenir exactement 2 lettres alphabétiques.");
    }
});


        const shakeKeyframes = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                20%, 40%, 60%, 80% { transform: translateX(5px); }
            }
        `;
        const style = document.createElement('style');
        style.textContent = shakeKeyframes;
        document.head.appendChild(style);

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const formCard = document.querySelector('.form-card');
            formCard.style.opacity = '0';
            formCard.style.transform = 'translateY(30px)';
            formCard.style.transition = 'opacity 0.6s ease, transform 0.6s ease';

            observer.observe(formCard);
        });
    </script>
</body>
</html>
