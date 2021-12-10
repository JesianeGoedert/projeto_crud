<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se GET 
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['id_marca']) ? $_GET['id_marca'] : 0;
        excluir($codigo);
    }

    // Se POST 
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id_marca']) ? $_POST['id_marca'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Funções
    function inserir($codigo){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO marca (nome) VALUES(:nome)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $stmt->execute();
        header("location:addmarca.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE marca SET nome = :nome  WHERE id_marca = :id_marca');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':id_marca', $codigo, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $codigo = $dados['id_marca'];
        $stmt->execute();
        header("location:consultamarca.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from marca WHERE id_marca = :id_marca');
        $stmt->bindParam('id_marca', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:consultamarca.php");
    }


    // Busca item do banco (id)
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM marca WHERE id_marca = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_marca'] = $linha['id_marca'];
            $dados['nome'] = $linha['nome'];
        }
        return $dados;
    }

    // Busca: dados form
    function dadosForm(){
        $dados = array();
        $dados['id_marca'] = $_POST['id_marca'];
        $dados['nome'] = $_POST['nome'];       
        return $dados;
    }

?>
