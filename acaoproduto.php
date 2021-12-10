<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se GET 
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['id_produto']) ? $_GET['id_produto'] : 0;
        excluir($codigo);
    }

    // Se POST 
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id_produto']) ? $_POST['id_produto'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Funções
    function inserir($codigo){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO produto (nome, valor) VALUES(:nome, :valor)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $valor = $dados['valor'];
        $stmt->execute();
        header("location:addproduto.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE produto SET nome = :nome,valor = :valor WHERE id_produto = :id_produto');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':valor', $valor, PDO::PARAM_STR);
        $stmt->bindParam(':id_produto', $codigo, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $valor = $dados['valor'];
        $codigo = $dados['id_produto'];
        $stmt->execute();
        header("location:consultaproduto.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from produto WHERE id_produto = :id_produto');
        $stmt->bindParam('id_produto', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:consultaproduto.php");
    }


    // Busca item do banco (id)
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM produto WHERE id_produto = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_produto'] = $linha['id_produto'];
            $dados['nome'] = $linha['nome'];
            $dados['valor'] = $linha['valor'];
        }
        return $dados;
    }

    // Busca: dados form
    function dadosForm(){
        $dados = array();
        $dados['id_produto'] = $_POST['id_produto'];
        $dados['nome'] = $_POST['nome'];
        $dados['valor'] = $_POST['valor'];       
        return $dados;
    }

?>