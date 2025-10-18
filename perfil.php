<?php 
session_start();
include "includes/banco.php";
include "includes/header.php";
include "includes/navbar.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['usuario_id'];

// ================== BUSCA DADOS DO USUÁRIO ==================
$stmt = $conn->prepare("SELECT id, nome, email, senha, imagem FROM alunos WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger text-center mt-3'>Usuário não encontrado.</div>";
    exit();
}

$usuario = $result->fetch_assoc();
$stmt->close();

// ================== ATUALIZAR DADOS ==================
if (isset($_POST['atualizar'])) {
    $novoNome = $_POST['nome'];
    $novoEmail = $_POST['email'];
    $novaSenha = $_POST['senha'];
    $novaImagem = $usuario['imagem']; // valor atual por padrão

    // Verifica se uma nova imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "assets/uploads/";
        $nomeArquivo = basename($_FILES['imagem']['name']);
        $caminhoImagem = $uploadDir . $nomeArquivo;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
            $novaImagem = $caminhoImagem;
        }
    }

    // Atualiza os dados
    $stmt = $conn->prepare("UPDATE alunos SET nome = ?, email = ?, senha = ?, imagem = ? WHERE id = ?");
    $stmt->bind_param("sssss", $novoNome, $novoEmail, $novaSenha, $novaImagem, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso!'); location.href='perfil.php';</script>";
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Erro ao atualizar: " . htmlspecialchars($stmt->error) . "</div>";
    }
    $stmt->close();
}

// ================== EXCLUIR CONTA ==================
if (isset($_POST['excluir'])) {
    $stmt = $conn->prepare("DELETE FROM alunos WHERE id = ?");
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        session_destroy();
        echo "<script>alert('Conta excluída com sucesso!'); location.href='login.php';</script>";
        exit();
    } else {
        echo "<div class='alert alert-danger text-center mt-3'>Erro ao excluir conta.</div>";
    }
    $stmt->close();
}
?>

  <div class="card shadow-lg p-4 border-0 bg-light-orange" style="max-width: 600px; width: 100%;">
    <h2 class="text-center text-orange fw-bold mb-4">Meu Perfil</h2>

    <!-- Imagem de perfil -->
    <div class="text-center mb-4">
      <img src="<?php echo htmlspecialchars($usuario['imagem']); ?>" 
           alt="Foto de perfil" 
           class="rounded-circle shadow-sm" 
           style="width: 120px; height: 120px; object-fit: cover;">
    </div>

    <!-- Formulário de edição -->
    <form method="post" enctype="multipart/form-data" class="needs-validation" novalidate>

      <!-- Nome -->
      <div class="mb-3">
        <label for="nome" class="form-label fw-semibold">Nome completo</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" class="form-control" required>
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label for="email" class="form-label fw-semibold">E-mail</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" class="form-control" required>
      </div>

      <!-- Senha -->
      <div class="mb-3">
        <label for="senha" class="form-label fw-semibold">Senha</label>
        <input type="password" name="senha" id="senha" value="<?php echo htmlspecialchars($usuario['senha']); ?>" class="form-control" required>
      </div>

      <!-- Nova Imagem -->
      <div class="mb-3">
        <label for="imagem" class="form-label fw-semibold">Alterar imagem</label>
        <input type="file" name="imagem" id="imagem" accept="image/*" class="form-control">
      </div>

      <!-- Botões -->
      <div class="d-flex justify-content-between mt-4">
        <button type="submit" name="atualizar" class="btn bg-orange text-white fw-semibold shadow-sm px-4">Salvar alterações</button>
        <button type="submit" name="excluir" class="btn btn-danger fw-semibold shadow-sm px-4" 
          onclick="return confirm('Tem certeza que deseja apagar sua conta? Essa ação não pode ser desfeita!');">
          Excluir conta
        </button>
      </div>
    </form>
  </div>
<?php

include "includes/footer.php";
?>
