<?php

require("../database/conexao.php");

switch ($_POST["acao"]) {
    case 'inserir':
       
        //TRATAMENTO DE IMAGEM PARA UPLOAD:
        

        // echo '<pre>';
        // var_dump($_FILES);
        // echo '</pre>';

        //RECUPERA O NOME DO ARQUIVO
        $nomeArquivo = $_FILES["foto"]["name"];

        //RECUPERAR A EXTENSÃO DO ARQUIVO
        $extensao = pathinfo($nomeArquivo, PATHINFO_EXTENSION);

        //definir um novo nome para o arquivo de imagem
        $novoNome = md5(microtime()) . "." . $extensao;

        // echo $nomeArquivo;
        // echo '<br>';
        // echo $novoNome;

        //UPLOAD DO ARQUIVO:
        move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/$novoNome");

        break;
    
    default:
        # code...
        break;
}

?>