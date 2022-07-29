<?php
    session_start();
    $erro = array('usuario'=>'','senha'=>'','form'=>'');
    $mensagem = array('sucesso'=>'','fracasso'=>'');
    if(isset($_COOKIE['usuario'])){
        echo "Acessado ultima vez em " .$_COOKIE['data'] ." pelo usuario ".$_COOKIE['usuario'];
    }
    if(isset($_POST['limparCookie'])){
        setcookie('usuario', '', time() - 3600, "/");
    }
    if(isset($_POST['acessar'])){
        if(empty($_POST['usuario'])){
            $erro['usuario'] = "Campo usuario não pode ser nulo!"; 
        }
        if(empty($_POST['senha'])){
            $erro['senha'] = "Campo senha não pode ser nulo!";
        }
        if(array_filter($erro)){
            $erro['form'] = "Preencha todos os campos corretamente!";
        }else{
            $sessao = $_SESSION['log'];
            $usuario = $sessao['usuario'];
            $senha = $sessao['senha'];
            if($_POST['usuario'] == $usuario and $_POST['senha'] == $senha){
                $mensagem['sucesso'] = "Acesso bem sucedido. Bem vindo ".$usuario;
                date_default_timezone_set("America/Sao_Paulo");
                $Object = new DateTime();  
                $DateAndTime = $Object->format("d-m-Y h:i:s a");
                setcookie('data', $DateAndTime, time() + (10 * 60), "/");
                setcookie('usuario', $usuario, time() + (10 * 60), "/");
            }else{
                $mensagem['fracasso'] = "Usuario e/ou senha estão incorretos!";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Acesso</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
    <fieldset>
    <a>Sistema de Acesso</a>
    <form action="index.php" method="POST">
        <label>Usuário:</label>
        <input type="text" name="usuario"></br>
        <div><?php echo $erro['usuario']; ?></div>
        <label>Senha:</label>
        <input type="password" name="senha"></br>
        <div><?php echo $erro['senha']; ?></div>
        <input class="enviar" type="submit" name="acessar"></br>
    </form>
    <a class="new" href="cadastro.php">Cadastrar novo usuario</a>
    <div class="form"><?php echo $erro['form']; ?></div>
    </fieldset>
    <div class="mensagem"><?php echo implode(" ", $mensagem); ?></div>
</body>
</html>