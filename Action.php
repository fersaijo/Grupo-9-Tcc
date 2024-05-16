<?php
require_once 'cabecalho.php';

session_start();

switch ($_POST) {
    //Login
    case isset($_POST['btnLogin']):
        login();
        break;

        //Cadastrar
    case isset($_POST['btnCadastrar']):
        cadastro();
        break;

        //Atualizar dados do usuário
    case isset($_POST['btnAtualizarDados']):
        atualizar();
        break;

        //Faz o logout
    case isset($_POST['btnSair']):
        session_destroy();
        header("Location: index.php");
        break;

        //Voltar para página principal do Aluno
    case isset($_POST['btnVoltarAluno']):
        header("Location: pagina_aluno.php");
        break;

        //Voltar para página principal do Docente
    case isset($_POST['btnVoltarDocente']):
        header("Location: pagina_professor.php");
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

                //Avisa a página que é um professor
                $_SESSION['professor'] = true;


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
        $linha = mysqli_fetch_array($resultado);
        if ($linha != null) {
            if ($linha['senha'] == $senha) {
                $_SESSION['logado'] = $nome;
                //Avisa que não é professor
                $_SESSION['professor'] = false;
                $_SESSION['id_pessoa'] = $linha['id_pessoa'];
                header("Location: pagina_aluno.php");

            } else {
                echo '
                    <a href="index.php" class="w3-cyan w3-link w3-display-middle">
                        <h1 class="w3-button w3-teal">Login Inválido! </h1>
                    </a> 
                    ';
            }
        } else {
            echo '
            <a href="index.php"class="w3-link w3-cyan w3-display-middle">
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
    //Verificando o tipo de usuário
    if(!isset($_SESSION['professor'])){
        echo 'Não logado';
    }else if( $_SESSION['professor'] == true){
        $tabela = 'docente';
    }else{
        $tabela = 'aluno';
    }
    
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
    $id_pessoa = $_SESSION['id_pessoa'];

    $sql = "UPDATE pessoa INNER JOIN $tabela ON $tabela.id_pessoa = pessoa.id SET pessoa.`nome` = ' $nome ', pessoa.`sobrenome` = '$sobrenome',
    pessoa.`data_Nascimento` = '$data',pessoa.numero = '$numero', pessoa.`logradouro` = '$logradouro', pessoa.`bairro` = '$bairro', pessoa.`complemento` = '$complemento',
     pessoa.`cidade` = '$cidade', pessoa.`uf` = '$uf',
     pessoa.`cep` = '$cep', $tabela.username = '$username', $tabela.senha = '$senha' WHERE `pessoa`.`id` = $id_pessoa ;";
    $_SESSION['id_pessoa'] = $id_pessoa; 
    if($conexao->query($sql)){
        if(!$_SESSION['professor']){
            echo '
            <a class="w3-button w3-cyan w3-display-middle" href="pagina_aluno.php">
                <h1 class="w3-button w3-teal">Dados atualizados com Sucesso! </h1>
            </a> 
            ';

        }else{
            echo '
            <a class="w3-button w3-cyan w3-display-middle" href="pagina_professor.php">
                <h1 class="w3-button w3-teal">Dados atualizados com Sucesso! </h1>
            </a> 
            ';
        }
    }else{
        echo '
        <a class="w3-button w3-cyan w3-display-middle" href="pagina_aluno.php">
            <h1 class="w3-button w3-teal">Erro na atualização! </h1>
        </a> 
        ';
    }
}