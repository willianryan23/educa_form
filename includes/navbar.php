
<nav class="navbar navbar-expand-lg  fixed-top">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="assets/images/educa_page-0001-removebg-preview.png" alt="Logo" class="logo">
        </a>

        <!-- Botão para menu colapsável (modo mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
            aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links da navbar -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarMenu">
            <ul class="navbar-nav d-flex align-items-center gap-4">
                <li class="nav-item">
                    <a class="nav-link fw-bold text-orange" href="index.php">INÍCIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-orange" href="formulario.php">FORMULÁRIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-orange" href="recomendacoes.php">RECOMENDAÇÕES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold text-orange" href="perfil.php">PERFIL</a>
                </li>

                <?php 
                    if (!isset($_SESSION['usuario_id'])) {
                        echo'
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-orange" href="login.php">LOGIN</a>
                            </li>
                        ';
                    } else {
                        echo'
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-orange" href="logout.php">SAIR</a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Imagem de fundo e container principal -->
<main>


         

