<!DOCTYPE html>
<?php
include_once "acaovenda.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "";
$dados;
if ($acao == 'editar'){
    $codigo = isset($_GET['id_venda']) ? $_GET['id_venda'] : "";
    if ($codigo > 0)
        $dados = buscarDados($codigo);
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Venda</title>

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
     <a href="consultavenda.php"><img src="img/eye_icon-icons.com_71204.svg" alt="" width="30" height="30"></a> 
     <a href="addvenda.php"><img src="https://svgsilh.com/svg/1970474.svg" alt="" width="30" height="24"></a>
    </div>
</nav><br>

<br><br>
<div id="form">
    <form action="acaovenda.php" method="post">
        <b> Insira os dados abaixo:</b><br>
        <input readonly  type="number" name="id_venda" id="id_venda" value="<?php if ($acao == "editar") echo $dados['id_venda']; else echo 0; ?>"><br><br>
        <b>Data da venda:</b><br>
        <input required=true   type="date" name="data_venda" id="data_venda" value="<?php if ($acao == "editar") echo $dados['data_venda']; ?>"><br>
        <b>Data de pagamento:</b><br>
        <input required=true   type="date" name="data_pagamento" id="data_pagamento" value="<?php if ($acao == "editar") echo $dados['data_pagamento']; ?>"><br>
        <br><button type="submit" name="acao" id="acao" value="salvar" class="btn btn-dark">Salvar</button>
    </form>
</div>
</body>
</html>