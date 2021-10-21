<?php
session_start();
/*CONEXÃO COM BANCO DE DADOS*/
require('../database/conexao.php');

/*FUNÇÃO DE VALIDAÇÃO*/
function validaCampos(){

    $erros = [];

    if(!isset($_POST['descricao']) || $_POST['descricao'] == ""){

        $erros[] = "O campo descrição é de preenchimento obrigatório";

    }

    return $erros;

}

/*
TRATAMENTO DOS DADOS VINDOS DO FORMULÁRIO

- TIPOS DA AÇÃO
- EXECUÇÃO DOS PROCESSOS DA AÇÃO SOLICITADA

*/
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

        /*MONTGEM DA INSTRUÇÃO SQL DE INSERÇÃO DE DADOS:*/
        $sql = "INSERT INTO tbl_categoria (descricao)
        VALUES ('$descricao')";

        // echo $sql;exit;

        /*
        mysql_query parametros:
        1 - Uma conexão aberta e válida
        2 - Uma instrução sql válida
        */
        $resultado = mysqli_query($conexao, $sql);

        header('location:index.php');

        // echo '<pre>';
        // var_dump($resultado);
        // echo '</pre>';
        // exit;

        break;

        case 'deletar':

            $categoriaID = $_POST['categoriaId'];

            $sql = "DELETE FROM tbl_categoria WHERE id = $categoriaID";

            $resultado = mysqli_query($conexao, $sql);

            header('location: index.php');

            break;

            case 'editar':

                //atualizando a imagem do produto
                $produtoId = $_POST["produtoId"];

                if($_FILES["foto"]["error"] != UPLOAD_ERR_NO_FILE){

                    $sqlImagem = "SELECT imagem FROM tbl_produto WHERE id = $produtoId";

                    $resultado = $mysqli_query($conexao, $sqlImagem);
                    $produto = mysqli_fetch_array($resultado);

                    // echo '/fotos/' . $produtos["imagem"];exit;
                }

                //captura os dados de texto do produto
                 $id = $_POST["id"];
                 $descricao = $_POST["descricao"];

                 $peso = str_replace(".", "", $_POST["peso"]);
                 $peso = str_replace(",", ".", $peso);

                 $valor = str_replace(".", "", $_POST["valor"]);
                 $valor = str_replace(",", ".", $valor);

                 $quantidade = $_POST["quantidade"];
                 $cor = $_POST["cor"];
                 $tamanho = $_POST["tamanho"];
                 $desconto = $_POST["desconto"];
                 $categoriaID = $_POST["categoria"];

                

                 $sql = "UPDATE tbl_categoria SET descricao = '$descricao' WHERE id = $id";
                //  echo $sql; exit;
                $resultado = mysqli_query($conexao, $sql);

                header('location: index.php');
            break;

           
    
    default:
        # code...
        break;
}



?>