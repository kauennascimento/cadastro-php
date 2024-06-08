<?php
session_start();
session_destroy();
header("Location: login.php?logout=1");
exit;
?>



<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
</head>
<body>
    <p>Você saiu da plataforma.</p>
</body>
</html>
