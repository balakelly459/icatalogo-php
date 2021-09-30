<?php

/*CONEXÃO COM BANCO DE DADOS*/
require('../database/conexao.php');

//TRATAMENTO DE DADOS VINDOS DO FORMULÁRIO

//TIPOS DA AÇÃO
//EXECUÇÃO DOS PROCESSOS DA AÇÃO SOLICITADA

switch ($_POST['acao']) {
    case 'inserir':
        // echo 'INSERIR';exit;
        $descricao = $_POST['descricao'];

        //MONTAGEM DE INSTRUÇÃO SQL DE INSERÇÃO DE DADOS:
        $sql = "INSERT INTO tbl_categoria (descricao) 
        VALUES ('$descricao') "; 

        // echo $sql;exit;

        //mysql_query parametros:
        // 1- uma conexão aberta e válida
        // 2- uma instrução sql válida
        $resultado = mysqli_query($conexao, $sql);

        header('location:index.php');
        
       echo '<pre>';
       var_dump($resultado);
       echo '<pre>';



        break;
    
    default:
        # code...
        break;
}

?>