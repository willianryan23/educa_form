<?php 

include "includes/banco.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $dificuldade = trim(mysqli_real_escape_string($conn, $_POST["dificuldade"]));
    $metodo_preferido = trim(mysqli_real_escape_string($conn, $_POST["metodo_preferido"]));
    $horario_estudo = trim(mysqli_real_escape_string($conn, $_POST["horario_estudo"]));
    $prefere = trim(mysqli_real_escape_string($conn, $_POST["prefere"]));
    $atrapalha = trim(mysqli_real_escape_string($conn, $_POST["atrapalha"]));
    $id_usuario = $_SESSION['usuario_id'];

    $stmt = $conn->prepare("INSERT INTO estudos (a_d, f_e, t_e, p_e, o_a, aluno_id) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $dificuldade, $metodo_preferido, $horario_estudo, $prefere, $atrapalha, $id_usuario);
    $stmt->execute();
    $stmt->close();

        echo "<script>alert('informações cadastradas com sucesso!'); window.location.href='recomendacoes.php';</script>";


    exit();

} else {
    echo "Erro ao fazer o cadastro.";
}

?>