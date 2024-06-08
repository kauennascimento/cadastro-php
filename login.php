<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

/*     $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql); */
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        echo "Usuário encontrado: " . $usuario['email'] . "<br>"; // Debugging
        echo "Hash armazenado: " . $usuario['senha'] . "<br>"; // Debugging
        echo "Senha fornecida: " . $senha . "<br>"; // Debugging
        if (password_verify($senha, $usuario['senha'])) {
            echo "Senha verificada com sucesso!<br>"; // Debugging
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['perfil_id'] = $usuario['perfil_id'];
            header("Location: dashboard.php");
            exit;
        } else {
            $erro = "Senha incorreta!";
            echo "Senha incorreta!<br>"; // Debugging
        }
    } else {
        $erro = "Usuário não encontrado!";
        echo "Usuário não encontrado!<br>"; // Debugging
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <?php if (isset($_GET['logout'])): ?>
        <p>Você saiu da plataforma.</p>
    <?php endif; ?>
    <form method="POST" action="login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
    <?php if (isset($erro)) { echo "<p>$erro</p>"; } ?>
</body>
</html>
