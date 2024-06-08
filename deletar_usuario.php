<?php
session_start();
include('db.php');

if ($_SESSION['perfil_id'] != 1) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$sql = "DELETE FROM usuarios WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    header("Location: dashboard.php");
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}
?>
