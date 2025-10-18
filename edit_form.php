<?php
session_start();
include "includes/banco.php";

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    echo "<script>alert('Faça o login antes de acessar esta página!');</script>";
    header("Location: login.php");
    exit();
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe e filtra os dados
    $aluno_id = $_SESSION['usuario_id'];
    $dificuldade = $_POST['dificuldade'] ?? '';
    $metodo = $_POST['metodo_preferido'] ?? '';
    $horario = $_POST['horario_estudo'] ?? '';
    $prefere = $_POST['prefere'] ?? '';
    $atrapalha = $_POST['atrapalha'] ?? '';

    // Atualiza no banco
    $stmt = $conn->prepare("UPDATE estudos SET a_d = ?, f_e = ?, t_e = ?, p_e = ?, o_a = ? WHERE aluno_id = ?");
    $stmt->bind_param("ssssss", $dificuldade, $metodo, $horario, $prefere, $atrapalha, $aluno_id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Respostas atualizadas com sucesso!');
                window.location.href = 'formulario.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao atualizar respostas: " . $stmt->error . "');
                window.history.back();
              </script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Método inválido.'); window.history.back();</script>";
}
?>
