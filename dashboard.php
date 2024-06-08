<?php
session_start();
include('db.php');

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$perfil_id = $_SESSION['perfil_id'];

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo ao Dashboard</h1>
    <?php if ($perfil_id == 1): // Administrador ?>
        <h2>CRUD de Usuários</h2>
        <a href="criar_usuario.php">Criar Usuário</a>
        <ul>
            <?php foreach ($usuarios as $usuario): ?>
                <li>
                    <?php echo $usuario['nome']; ?> - <?php echo $usuario['email']; ?>
                    <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    <a href="deletar_usuario.php?id=<?php echo $usuario['id']; ?>">Deletar</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: // Colaborador ?>
        <h2>Dados Cadastrados</h2>
        <ul>
            <?php foreach ($usuarios as $usuario): ?>
                <li><?php echo $usuario['nome']; ?> - <?php echo $usuario['email']; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="logout.php">Logout</a>
</body>
</html>
