<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se GET 
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['id_fabricante']) ? $_GET['id_fabricante'] : 0;
        excluir($codigo);
    }

    // Se POST 
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id_fabricante']) ? $_POST['id_fabricante'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Funções
    function inserir($codigo){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO fabricante (nome) VALUES(:nome)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $stmt->execute();
        header("location:addfabricante.php");
        
    }


    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE fabricante SET nome = :nome WHERE id_fabricante = :id_fabricante');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':id_fabricante', $codigo, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $codigo = $dados['id_fabricante'];
        $stmt->execute();
        header("location:consultafabricante.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from fabricante WHERE id_fabricante = :id_fabricante');
        $stmt->bindParam('id_fabricante', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:consultafabricante.php");
    }


    // Busca item do banco (id)
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM fabricante WHERE id_fabricante = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_fabricante'] = $linha['id_fabricante'];
            $dados['nome'] = $linha['nome'];
        }
        return $dados;
    }

    // Busca: dados form
    function dadosForm(){
        $dados = array();
        $dados['id_fabricante'] = $_POST['id_fabricante'];
        $dados['nome'] = $_POST['nome'];       
        return $dados;
    }

?>