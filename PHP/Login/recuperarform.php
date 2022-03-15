<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar</title>
</head>
<body>
    <form action="recuperar.php?cod=<?php echo $_GET['cod']; ?>" method="post">
        <input type="text" name="senha" placeholder="Nova senha"><br><br>
        <input type="text" placeholder="Confirme a senha">
        <input type="submit">
    </form>
</body>
</html>


