<?php
session_start();
/*CONEXÃO COM BANCO DE DADOS*/
require('../database/conexao.php');

//FUNÇÃO DE VALIDAÇÃO
function validaCampos(){

    $erros = [];

    if(isset($_POST['descricao']) || $_POST['descricao'] == ""){

        $erros[] = "O campo descrição é de preenchimento obrigatório";
    }

    return $erros;

}

//TRATAMENTO DE DADOS VINDOS DO FORMULÁRIO

//TIPOS DA AÇÃO
//EXECUÇÃO DOS PROCESSOS DA AÇÃO SOLICITADA

switch ($_POST['acao']) {
    case 'inserir':

        //CHAMADA DA FUNÇÃO DE VALIDAÇÃO DE ERROS:
        $erros = validaCampos();

        //VERIFICAR SE EXISTEM ERROS:
        if(count($erros) > 0){

            $_SESSION["erros"] = $erros;

            header('location: index.php');

            exit();
        }


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

        case 'deletar': 
            
            $categoriaID = $_POST['categoriaId'];

            $sql = "DELETE FROM tbl_categoria WHERE id= $categoriaID";

            $resultado = mysqli_query($conexao, $sql);

            header('location: index.php');
            
            
            break;
    
    default:
        # code...
        break;
}

?>