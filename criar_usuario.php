<?php
session_start();
include('db.php');

if ($_SESSION['perfil_id'] != 1) {
    header("Location: dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $perfil_id = $_POST['perfil_id'];

    $sql = "INSERT INTO usuarios (nome, email, senha, perfil_id) VALUES ('$nome', '$email', '$senha', '$perfil_id')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Criar Usuário</title>
</head>
<body>
    <form method="POST" action="criar_usuario.php">
        <input type="text" name="nome" placeholder="Nome" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <select name="perfil_id">
            <option value="1">Administrador</option>
            <option value="2">Colaborador</option>
        </select>
        <button type="submit">Criar</button>
    </form>
</body>
</html>
