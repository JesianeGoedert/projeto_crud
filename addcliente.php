<!DOCTYPE html>
<?php
include_once "acaocliente.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Cliente</title>

    <style>
        #form {
        width: 100%;
        display: flex;
        justify-content: center
        }
    </style>  

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</head>
<body>
<br>

<nav class="navbar navbar-light bg-light">
   <div class="container-md">
     <a class="navbar-brand" href="menu.php"><img src="https://image.flaticon.com/icons/png/512/60/60602.png" alt="" width="30" height="24"></a>
     <a href="consultacliente.php"><img src="img/eye_icon-icons.com_71204.svg" alt="" width="30" height="30"></a> 
     <a href="addcliente.php"><img src="https://svgsilh.com/svg/1970474.svg" alt="" width="30" height="24"></a>
    </div>
</nav><br>

<br>

<div id="form">
    <form action="acaocliente.php" method="post">
        <b>Insira os dados abaixo: </b><br>
        <input readonly  type="number" name="id_cliente" id="id_cliente" value="<?php if ($acao == "editar") echo $dados['id_cliente']; else echo 0; ?>"><br><br>
        <b>Nome:</b><br>
        <input required=true   type="text" name="nome" id="nome" value="<?php if ($acao == "editar") echo $dados['nome']; ?>"><br>
        <b>CPF:</b><br>
        <input required=true   type="text" name="cpf" id="cpf" value="<?php if ($acao == "editar") echo $dados['cpf']; ?>"><br>
        <b>Telefone:</b><br>
        <input required=true   type="text" name="telefone" id="telefone" value="<?php if ($acao == "editar") echo $dados['telefone']; ?>"><br>
        <b>Endereço:</b><br>
        <input required=true   type="text" name="endereco" id="endereco" value="<?php if ($acao == "editar") echo $dados['endereco']; ?>"><br>
        <br><button type="submit" name="acao" id="acao" value="salvar" class="btn btn-dark">Salvar</button>
    </form>
</div>
</body>
</html>