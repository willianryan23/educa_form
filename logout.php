<?php 

session_start(); // Inicia a sessão (necessário para poder destruí-la)

// Remove todas as variáveis da sessão
$_SESSION = [];

// Finalmente, destrói a sessão
session_destroy();

// Redireciona o usuário para a página de login (ou outra página desejada)
header("Location: index.php");
exit();

?>