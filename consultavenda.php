<!DOCTYPE html>
    <?php
        include_once "conf/default.inc.php";
        require_once "conf/Conexao.php";
    ?>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Vendas</title>
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>

    <style>
        table {
            text-align: center;
            margin: 0 auto;
            border-collapse: collapse;
            border-radius: 5px;
            border-style: hidden;
            box-shadow: 0 0 0 1px black;
        }

        tr,
        th,
        td {
            border: 1px solid black;
        }

        th {
            width: 150px;
        }

        a {
            text-decoration: none;
        }

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
    <nav class="navbar navbar-light bg-light">
        <div class="container-md">
            <a class="navbar-brand" href="menu.php"><img src="https://image.flaticon.com/icons/png/512/60/60602.png" alt="" width="30" height="24"></a> 
            <a href="consultavenda.php"><img src="img/eye_icon-icons.com_71204.svg" alt="" width="30" height="30"></a> 
            <a href="addvenda.php"><img src="https://svgsilh.com/svg/1970474.svg" alt="" width="30" height="24"></a>
        </div>
    </nav><br>

<div id="form">
    <form method="POST">
        <b>Pesquisar por:</b> <br>
        <input type="radio" name="optionSearchUser" id="" value="id_venda" required>Código<br><br>
    
        <b>Ordenar por:</b> <br>
        <input type="radio" name="optionOrderUser" id="" value="id_venda" required>Código<br><br>

        <input type="text" name="valorUser">
        <input type="submit" value="Pesquisar" class="btn btn-dark">
    </form>
</div>
    <?php

    try {

        $optionSearchUser = isset($_POST["optionSearchUser"]) ? $_POST["optionSearchUser"] : "";
        $optionOrderUser = isset($_POST["optionOrderUser"]) ? $_POST["optionOrderUser"] : "";
        $valorUser = isset($_POST["valorUser"]) ? $_POST["valorUser"] : "";

        $sql = "";

        if ($optionSearchUser != "") {
            if ($valorUser == "") {

                $sql = ("SELECT * FROM venda ORDER BY $optionOrderUser;");
            } elseif ($optionSearchUser == "id_venda") {
                $sql = ("SELECT * FROM venda WHERE $optionSearchUser LIKE '$valorUser%' ;");
            } else {
                $sql = ("SELECT * FROM venda WHERE $optionSearchUser LIKE '$valorUser%' ORDER BY $optionOrderUser;");
            }
        } else {
            $sql = ("SELECT * FROM venda;");
        }
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query($sql);
        echo "<br><table><tr><th>Código</th><th>Data da venda</th><th>Data de pagamento</th><th>Alterar</th><th>Excluir</th></tr>";
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>
            <tr>
                <td><?php echo $linha['id_venda']; ?></td>
                <td><?php echo $linha['data_venda']; ?></td>
                <td><?php echo $linha['data_pagamento']; ?></td>
                <td><a href='addvenda.php?acao=editar&id_venda=<?php echo $linha['id_venda']; ?>'><img class="icon" src="img/edit.png" alt=""></a></td>
                <td><a href="javascript:excluirRegistro('addvenda.php?acao=excluir&id_venda=<?php echo $linha['id_venda']; ?>')"><img class="icon" src="img/delete.png" alt=""></a></td>
            </tr>
        <?php } ?>
        </table>

    <?php
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</body>
</html>