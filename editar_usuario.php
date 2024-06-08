<?php
session_start();
include('db.php');

if ($_SESSION['perfil_id'] != 1) {
    header("Location: dashboard.php");
    exit;
}

$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE id = $id";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $perfil_id = $_POST['perfil_id'];

    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email', perfil_id = '$perfil_id' WHERE id = $id";
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
    <title>Editar Usuário</title>
</head>
<body>
    <form method="POST" action="editar_usuario.php?id=<?php echo $id; ?>">
        <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
        <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
        <select name="perfil_id">
            <option value="1" <?php if ($usuario['perfil_id'] == 1) echo 'selected'; ?>>Administrador</option>
            <option value="2" <?php if ($usuario['perfil_id'] == 2) echo 'selected'; ?>>Colaborador</option>
        </select>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
