<?php

    session_start();
    
    include 'includes/header.php';
    include 'includes/navbar.php';
    include 'includes/banco.php';

    
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            die("Erro: Token CSRF inválido");
        }

        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>
                alert('Por favor, insira um e-mail válido.');
                window.location.href = 'cadastro.php';
            </script>";
            exit();
        }

        $senha = $_POST["senha"];

        if (!preg_match('/^(?=.*\d)[A-Za-z\d]{8,}$/', $senha)) {
            echo "<script>
                alert('A senha deve ter pelo menos 8 caracteres e conter pelo menos um número.');
                window.location.href = 'cadastro.php';
            </script>";
            exit();
        }


        $imagem = $_FILES['imagem']['name'];
        $caminho = "assets/uploads/" . $imagem;

        if (empty($id) || empty($nome) || empty($email) || empty($senha) || empty($caminho) || empty($imagem)) {
            echo "<script>
                alert('Por favor, preencha todos os campos obrigatórios.');
                window.location.href = 'cadastro.php';
            </script>";
            exit();
        }

        // Verifica se já existe usuário com mesmo id ou email
        $stmt = $conn->prepare("SELECT id, email FROM alunos WHERE id = ? OR email = ?");
        $stmt->bind_param("ss", $id, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>
                alert('Nome de usuário já cadastrado. Escolha outro.');
                window.location.href = 'cadastro.php';
            </script>";
            $stmt->close();
            exit();
        }
        $stmt->close();



        // Move o arquivo e insere no banco
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {

            $stmt = $conn->prepare("INSERT INTO alunos (id, nome, email, senha, imagem) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $id, $nome, $email, $senha, $caminho);

            if ($stmt->execute()) {
                echo "<script>alert('Cadastro realizado com sucesso!');</script>";
                echo "<script>location.href = 'login.php';</script>";
                exit();
            } else {
                echo "<div class='alert alert-danger text-center mt-3'>Erro ao cadastrar: " . htmlspecialchars($stmt->error) . "</div>";
            }
            $stmt->close();
        }
    }
?>

    <div class="card shadow-lg p-4 border-0 bg-light-orange">
        <h2 class="text-center text-orange fw-bold mb-4">Crie sua conta</h2>

        <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

            <!-- Nome de usuário -->
            <div class="mb-3">
                <label for="id" class="form-label fw-semibold">Nome de usuário</label>
                <input type="text" name="id" id="id" class="form-control" placeholder="Escolha um nome de usuário" required>
                <div class="invalid-feedback">Por favor, insira um nome de usuário.</div>
            </div>

            <!-- Nome completo -->
            <div class="mb-3">
                <label for="nome" class="form-label fw-semibold">Nome completo</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Digite seu nome completo" required>
                <div class="invalid-feedback">Por favor, insira seu nome completo.</div>
            </div>

            <!-- E-mail -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite seu e-mail" required>
                <div class="invalid-feedback">Por favor, insira um e-mail válido.</div>
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <label for="senha" class="form-label fw-semibold">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Crie uma senha" required>
                <div class="invalid-feedback">Por favor, crie uma senha.</div>
            </div>

            <!-- Imagem -->
            <div class="mb-3">
                <label class="form-label">Imagem</label>
                <input type="file" name="imagem" accept="image/*" class="form-control" required>
            </div>

            <!-- Botão -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn bg-orange text-white fw-semibold py-2 shadow-sm">Finalizar cadastro</button>
            </div>

            <!-- Link para login -->
            <div class="text-center">
                <span>Já tem uma conta? </span>
                <a href="login.php" class="text-orange fw-semibold text-decoration-none">Faça login</a>
            </div>
        </form>
    </div>

<?php include 'includes/footer.php'; ?>
