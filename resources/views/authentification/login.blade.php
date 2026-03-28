<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plateforme sous-traitants</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- CSS local -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-wrapper">
        <div class="card login-card p-4">
            <div class="text-center mb-4">
                <img src="{{ asset('images/logoAT.png') }}" alt="Logo" class="logo">
                <h5 class="platform-title">Plateforme de gestion des sous-traitants</h5>
            </div>

            <form method="POST" action="{{ route('login.submit') }}">
           
                @csrf

                <div class="mb-3">
                    <label class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="Entrer votre email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Mot de passe</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Entrer votre mot de passe" required>
                        <i class="bi bi-eye-slash toggle-password" onclick="togglePassword()"></i>
                    </div>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <button type="submit" class="btn login-btn w-100">Se connecter</button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.querySelector(".toggle-password");

            if (password.type === "password") {
                password.type = "text";
                icon.classList.remove("bi-eye-slash");
                icon.classList.add("bi-eye");
            } else {
                password.type = "password";
                icon.classList.remove("bi-eye");
                icon.classList.add("bi-eye-slash");
            }
        }
    </script>
</body>
</html>