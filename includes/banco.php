<?php 
$conn = mysqli_connect("localhost", "root", "", "educa_forms");

//  $conn = mysqli_connect("sql213.infinityfree.com", "if0_40099323", "twCVkVO0jMpUhZ", "if0_40099323_educa_forms");
if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

?>