<?php
session_start();

switch ($_POST) {
    case isset($_POST['btnLogin']):
        login();
        break;

    case isset($_POST['btnCadastrar']):
        cadastro();
        break;

    case isset($_POST['btnAtualizarDados']):
        atualizar();
        break;

    case isset($_POST['btnSair']):
        //session_destroy();
        header("Location: index.php");
        break;

    case isset($_POST['btnVoltarAluno']):
        header("Location: pagina_aluno.php");
        break;
}
function conectar(){
    require_once 'ConexaoBD.php';

    $conn = new ConexaoBD();
    $conexao = $conn->conectar();


    if ($conexao->connect_errno) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    return $conexao;
}

function login()
{
   

    $conexao = conectar();
    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];
    
    $professor = $_POST['professor'];
    //se for on é professor
    if ($professor == 'on') {
        $sql = "SELECT * FROM pessoa p, docente WHERE docente.username =  '" . $nome . "';";
        $resultado = $conexao->query($sql);
        $linha = mysqli_fetch_array($resultado);
        if ($linha != null) {
            if ($linha['senha'] == $senha) {
                $_SESSION['logado'] = $nome;
                $_SESSION['id_pessoa'] = $linha['id_pessoa'];
                header("Location: pagina_professor.php");
            } else {
                echo '
                    <a href="index.php">
                        <h1 class="w3-button w3-teal">Dados inválidos! </h1>
                    </a> 
                    ';
            }
        } else {
            echo '
                <a href="index.php">
                    <h1 class="w3-button w3-teal">Login Inválido! </h1>
                </a> 
                ';
        }

    } else {// ser for aluno
        $sql = "SELECT * FROM aluno WHERE username =  '" . $nome . "';";
        $resultado = $conexao->query($sql);
        echo $sql;
        $linha = mysqli_fetch_array($resultado);
        if ($linha != null) {
            if ($linha['senha'] == $senha) {
                $_SESSION['nome'] = $nome;
                
                $_SESSION['id_pessoa'] = 0;
                echo $_SESSION['id_pessoa']; 
                require_once 'pagina_aluno.php';

            } else {
                echo '
                    <a href="index.php" class="w3-cyan w3-link">
                        <h1 class="w3-button w3-teal">Login Inválido! </h1>
                    </a> 
                    ';
            }
        } else {
            echo '
            <a href="index.php"class="w3-link w3-cyan">
                <h1 class="w3-button w3-teal">Login Inválido! </h1>
            </a> 
            ';
        }
    }
    

    $conexao->close();

}

function cadastro()
{
    session_start();
    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];

    $professor = $_POST['professor'];
    //se for on é professor
    
    $conexao = conectar();

    $nome = $_POST['txtNome'];
    $sobrenome = $_POST['txtSobrenome'];

    $data = date("Y-m-d", strtotime($_POST["txtData"]));
    $logradouro = $_POST['txtLogradouro'];
    $numero = $_POST['txtNumero'];
    $complemento = $_POST['txtComplemente'];
    $bairro = $_POST['txtBairro'];
    $cidade = $_POST['txtCidade'];
    $uf = $_POST['txtEstado'];
    $cep = $_POST['txtCEP'];
    $username = $_POST['txtUsuario'];
    $senha = $_POST['txtSenha'];

    $sql = "INSERT INTO `pessoa` (`nome`, `sobrenome`, `data_Nascimento`, `logradouro`, `numero`, `bairro`, `complemento`, `cidade`, `uf`, `cep`) 
    VALUES ('$nome', '$sobrenome', '$data', '$logradouro', '$numero', '$bairro', '$complemento', '$cidade', '$uf', '$cep');";
    

    if ($conexao->query($sql) === TRUE) {
        $id = mysqli_insert_id($conexao);

        $sql2 = "INSERT INTO aluno (id_pessoa,username,senha) 
        VALUES ('$id','$username','$senha'); ";

        if ($conexao->query($sql2)) {
            echo '
            <a href="index.php">
                <h1 class="w3-button w3-teal">Cadastro feito com Sucesso! </h1>
            </a> 
            ';
            require 'index.php';
        } else {
            echo '
            <a href="index.php">
                <h1 class="w3-button w3-teal">Erro na atualização! </h1>
            </a> 
            ';
        }

    } else {
        echo '
        <a href="index.php">
            <h1 class="w3-button w3-teal">Erro na conexão! </h1>
        </a> 
        ';
    }

    $conexao->close();
}

function atualizar()
{
    $conexao = conectar();

    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];
    $sobrenome = $_POST["txtSobrenome"];
    $data = date("Y-m-d", strtotime($_POST["txtData"]));
    $logradouro = $_POST['txtLogradouro'];
    $numero = $_POST['txtNumero'];
    $complemento = $_POST['txtComplemento'];
    $bairro = $_POST['txtBairro'];
    $cidade = $_POST['txtCidade'];
    $uf = $_POST['txtEstado'];
    $cep = $_POST['txtCEP'];
    $username = $_POST['txtUsuario'];
    $senha = $_POST['txtSenha'];
    $id_pessoa = $_POST['txtId'];

    $sql = "UPDATE pessoa INNER JOIN aluno ON aluno.id_pessoa = pessoa.id SET pessoa.`nome` = ' $nome ', pessoa.`sobrenome` = '$sobrenome',
    pessoa.`data_Nascimento` = '$data',pessoa.numero = '$numero', pessoa.`logradouro` = '$logradouro', pessoa.`bairro` = '$bairro', pessoa.`complemento` = '$complemento',
     pessoa.`cidade` = '$cidade', pessoa.`uf` = '$uf',
     pessoa.`cep` = '$cep', aluno.username = '$username', aluno.senha = '$senha' WHERE `pessoa`.`id` = $id_pessoa ;";
    $_SESSION['id_pessoa'] = $id_pessoa; 
    if($conexao->query($sql)){
        echo '
        <a class="w3-button w3-cyan" href="pagina_aluno.php">
            <h1 class="w3-button w3-teal">Dados atualizados com Sucesso! </h1>
        </a> 
        ';
    }else{
        echo '
        <a class="w3-button w3-cyan" href="pagina_aluno.php">
            <h1 class="w3-button w3-teal">Erro na atualização! </h1>
        </a> 
        ';
    }
}