<?php
    session_start();
    $erro = array('usuario'=>'', 'senha'=>'', 'form'=>'');
    if(isset($_POST['cadastrar'])){
       if(empty($_POST['usuario'])){
            $erro['usuario'] = "Campo usuario não pode ser nulo!";  
        }
        if(empty($_POST['senha'])){
            $erro['senha'] = "Campo senha não pode ser nulo!";
        }
        if(array_filter($erro)){
            $erro['form'] = "Preencha todos os campos corretamente!";
        }else{
            $sessao = array('usuario'=>$_POST['usuario'],'senha'=>$_POST['senha']);
            $_SESSION['log'] = $sessao;
            header("Location:index.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<link rel="stylesheet" type="text/css" href="style.css">
<body>
    <fieldset>
    <a>Sistema de cadastro</a>
    <form action="cadastro.php" method="POST">
        <label>Usuario:</label>
        <input type="text" name="usuario"></br>
        <div><?php echo $erro['usuario']; ?></div>
        <label>Senha:</label>
        <input type="password" name="senha"></br>
        <div><?php echo $erro['senha']; ?></div>
        <label>Nome completo:</label>
        <input type="text" name="nome"></br>
        <label>Data nascimento:</label>
        <input type="date" name="data"></br>
        <label>Sexo:</label>
        <input type="radio" name="sexo" value="Masculino">Masculino
        <input type="radio" name="sexo" value="Feminino">Feminino</br>
        <label>Email:</label>
        <input type="email" name="email"></br>
        <label>Endereço:</label>
        <input type="text" name="endereco"></br>
        <input class="enviar" type="submit" name="cadastrar" value="Cadastrar"></br>
        <a class="new" href="index.php">Ja possuo cadastro</a>
        <div class="form"><?php echo $erro['form']; ?></div>
    </form>
</fieldset>
</body>
</html>