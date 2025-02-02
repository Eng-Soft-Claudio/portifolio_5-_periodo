<?php include('header.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descubra seu Signo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            width: 300px;
            height: 300px;
            object-fit: cover;
            margin: auto;
            display: block;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
      <div class="container-fluid">
        <img src="../assets/imgs/logo.png" class="img-fluid rounded-circle" alt="Logo" style="height: 50px;">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contato</a></li>
            </ul>
            <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle" id="darkModeLabel">Modo Escuro</label>
            </div>
        </div>
      </div>
    </nav>
</header>

<main class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <h1 class="text-center mb-4">Descubra seu Signo</h1>
            <form action="show_zodiac_sign.php" method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento:</label>
                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
        </div>
    </div>
    <section class="container mt-5">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php
                $pasta_imagens = "../assets/imgs/";
                $imagens = glob($pasta_imagens . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
                echo '<div class="carousel-item active" data-bs-interval="5000">
                        <img src="../assets/imgs/logo.png" class="d-block rounded-circle" alt="Logo">
                      </div>';
                foreach ($imagens as $imagem) {
                    if ($imagem !== "../assets/imgs/logo.png") {
                        echo '<div class="carousel-item" data-bs-interval="2000">
                                <img src="' . $imagem . '" class="d-block rounded-5" alt="Imagem do Carrossel">
                              </div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>
</main>
<footer class="bg-dark text-white text-center p-3 mt-auto">
    <p class="mb-0">&copy; 2025 Descubra seu Signo. Todos os direitos reservados.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleSwitch = document.getElementById("darkModeToggle");
        const darkModeLabel = document.getElementById("darkModeLabel");
        const body = document.body;
        const navbar = document.getElementById("navbar");
        if (localStorage.getItem("dark-mode") === "enabled") {
            ativarModoEscuro();
            toggleSwitch.checked = true;
        }
        toggleSwitch.addEventListener("change", function () {
            if (this.checked) {
                ativarModoEscuro();
                localStorage.setItem("dark-mode", "enabled");
            } else {
                ativarModoClaro();
                localStorage.setItem("dark-mode", "disabled");
            }
        });
        function ativarModoEscuro() {
            body.classList.add("bg-dark", "text-light");
            navbar.classList.remove("bg-light");
            navbar.classList.add("bg-dark", "navbar-dark");
            darkModeLabel.textContent = "Modo Claro";
        }
        function ativarModoClaro() {
            body.classList.remove("bg-dark", "text-light");
            navbar.classList.remove("bg-dark", "navbar-dark");
            navbar.classList.add("bg-light");
            darkModeLabel.textContent = "Modo Escuro";
        }
    });
</script>
</html>
