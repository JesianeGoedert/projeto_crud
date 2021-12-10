<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    // Se GET 
    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "excluir"){
        $codigo = isset($_GET['id_vendedor']) ? $_GET['id_vendedor'] : 0;
        excluir($codigo);
    }

    // Se POST
    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "salvar"){
        $codigo = isset($_POST['id_vendedor']) ? $_POST['id_vendedor'] : "";
        if ($codigo == 0)
            inserir($codigo);
        else
            editar($codigo);
    }

    // Funções
    function inserir($codigo){
        $dados = dadosForm();
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO vendedor (nome, cpf, telefone) VALUES(:nome, :cpf, :telefone)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $cpf = $dados['cpf'];
        $telefone = $dados['telefone'];
        $stmt->execute();
        header("location:addvendedor.php");
        
    }

    function editar($codigo){
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('UPDATE vendedor SET nome = :nome, cpf= :cpf, telefone= :telefone WHERE id_vendedor = :id_vendedor');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':cpf', $cpf, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
        $stmt->bindParam(':id_vendedor', $codigo, PDO::PARAM_INT);
        $nome = $dados['nome'];
        $cpf = $dados['cpf'];
        $telefone = $dados['telefone'];
        $codigo = $dados['id_vendedor'];
        $stmt->execute();
        header("location:consultavendedor.php");
    }

    function excluir($codigo){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from vendedor WHERE id_vendedor = :id_vendedor');
        $stmt->bindParam('id_vendedor', $codigo, PDO::PARAM_INT);
        $codigo = $codigo;
        $stmt->execute();
        header("location:consultavendedor.php");
    }


    // Buscar item do banco (id)
    function buscarDados($codigo){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM vendedor WHERE id_vendedor = $codigo");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['id_vendedor'] = $linha['id_vendedor'];
            $dados['nome'] = $linha['nome'];
            $dados['cpf'] = $linha['cpf'];
            $dados['telefone'] = $linha['telefone'];
        }
        return $dados;
    }

    // Busca: dados form
    function dadosForm(){
        $dados = array();
        $dados['id_vendedor'] = $_POST['id_vendedor'];
        $dados['nome'] = $_POST['nome'];  
        $dados['cpf'] = $_POST['cpf'];  
        $dados['telefone'] = $_POST['telefone'];         
        return $dados;
    }

?>