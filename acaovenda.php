<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se GET 
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['id_venda']) ? $_GET['id_venda'] : 0;
        excluir($codigo);
    }

    // Se POST 
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id_venda']) ? $_POST['id_venda'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Funções
    function inserir($codigo){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO venda (data_venda, data_pagamento) VALUES(:data_venda, :data_pagamento)');
        $stmt->bindParam(':data_venda', $data_venda, PDO::PARAM_STR);
        $stmt->bindParam(':data_pagamento', $data_pagamento, PDO::PARAM_STR);
        $data_venda = $dados['data_venda'];
        $data_pagamento = $dados['data_pagamento'];
        $stmt->execute();
        header("location:addvenda.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE venda SET data_venda = :data_venda, data_pagamento= :data_pagamento WHERE id_venda = :id_venda');
        $stmt->bindParam(':data_venda', $data_venda, PDO::PARAM_STR);
        $stmt->bindParam(':data_pagamento', $data_pagamento, PDO::PARAM_STR);
        $stmt->bindParam(':id_venda', $codigo, PDO::PARAM_INT);
        $data_venda = $dados['data_venda'];
        $data_pagamento = $dados['data_pagamento'];
        $endereco = $dados['endereco'];
        $codigo = $dados['id_venda'];
        $stmt->execute();
        header("location:consultavenda.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from venda WHERE id_venda = :id_venda');
        $stmt->bindParam('id_venda', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:consultavenda.php");
    }


    // Buscar item do banco (id)
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM venda WHERE id_venda = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_venda'] = $linha['id_venda'];
            $dados['data_venda'] = $linha['data_venda'];
            $dados['data_pagamento'] = $linha['data_pagamento'];
        }
        return $dados;
    }

    // Busca: dados form
    function dadosForm(){
        $dados = array();
        $dados['id_venda'] = $_POST['id_venda'];
        $dados['data_venda'] = $_POST['data_venda'];
        $dados['data_pagamento'] = $_POST['data_pagamento'];       
        return $dados;
    }

?>