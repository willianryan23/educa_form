<?php
session_start();

include "includes/banco.php";
include "includes/header.php";
include "includes/navbar.php";


// ==================== VERIFICA LOGIN ====================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $acesso = $_POST['acesso'] ?? '';

    $stmt = $conn->prepare("SELECT id, email, senha FROM alunos WHERE id = ? OR email = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $linha = $result->fetch_assoc();
        $senha = $linha["senha"] ?? '';

        if ($senha == $acesso) {
            $_SESSION['usuario_id'] = $linha['id'];
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='alert alert-danger text-center mt-3'>Login ou senha incorretos.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Usuário não encontrado.</div>";
    }
    $stmt->close();
}
?>

  <div class="card shadow-lg p-4 border-0 bg-light-orange">
    <h2 class="text-center text-orange fw-bold mb-4">Acesse sua conta</h2>

    <form method="post" action="" class="needs-validation" novalidate>
      <!-- Login -->
      <div class="mb-3">
        <label for="login" class="form-label fw-semibold">Login</label>
        <input type="text" name="login" id="login" class="form-control" placeholder="Digite seu login" required>
        <div class="invalid-feedback">Por favor, insira seu login.</div>
      </div>

      <!-- Senha -->
      <div class="mb-4">
        <label for="acesso" class="form-label fw-semibold">Senha</label>
        <input type="password" name="acesso" id="acesso" class="form-control" placeholder="Digite sua senha" required>
        <div class="invalid-feedback">Por favor, insira sua senha.</div>
      </div>

      <!-- Botão Entrar -->
      <div class="d-grid mb-3">
        <button type="submit" class="btn bg-orange text-white fw-semibold py-2 shadow-sm">Entrar</button>
      </div>

      <!-- Link de cadastro -->
      <div class="text-center">
        <span>Não tem uma conta? </span>
        <a href="cadastro.php" class="text-orange fw-semibold text-decoration-none">Cadastre-se</a>
      </div>
    </form>
  </div>

<?php include 'includes/footer.php'; ?>
