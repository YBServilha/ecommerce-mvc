<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVALIAÇÃO</title>
    <link rel="stylesheet" href="view/css/estilo.css">
</head>
<body>
    <br><br><br>
    <div id="login">
        <form action="controller/admController.php" method="post" name="loginAdm">
            <input type="hidden" name="admLogin" value="1">
            <input type="text" name="email" placeholder="login" value="adm@aval.com.br" class="formLogin"><br>
            <input type="password" name="senha" placeholder="senha" value="adm$123" class="formLogin"><br>
            <input type="submit" name="sbmt" value=" E N T R A R " class="formLoginBtn"><br>
        </form>
    </div>

    <?php
	if(isset($_REQUEST['msg'])){
		require_once 'view/msg.php';
		$cod = $_REQUEST['msg'];
		$msgExibir = $MSG[$cod];
		echo "<script>alert('".$msgExibir."')</script>";
	}
	?>
</body>
</html>