<?php include('header.php'); ?>
<body class="d-flex flex-column min-vh-100">
    
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
      <div class="container-fluid">
        <img src="../assets/imgs/logo.png" class="img-fluid rounded-circle" alt="Logo">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="../layouts/index.php">Início</a></li>
                <li class="nav-item"><a class="nav-link" href="../layouts/about.php">Sobre</a></li>
                <li class="nav-item"><a class="nav-link" href="../layouts/contact.php">Contato</a></li>
            </ul>
            <div class="form-check form-switch ms-3">
                <input class="form-check-input" type="checkbox" id="darkModeToggle">
                <label class="form-check-label" for="darkModeToggle" id="darkModeLabel">Modo Escuro</label>
            </div>
        </div>
      </div>
    </nav>
</header>

<main class="container main-content">
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

    <section class="carousel-container">
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

<footer class="footer">
    <p>&copy; 2025 Descubra seu Signo. Todos os direitos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
