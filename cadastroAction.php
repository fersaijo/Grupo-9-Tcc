<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle" >
    <?php
    session_start();    
    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];
    
    $professor = $_POST['professor'];
    //se for on é professor

    require_once 'ConexaoBD.php';
    
    $conn = new ConexaoBD();
    $conexao = $conn->conectar();
    if( $conexao->connect_errno){
        die("Falha na conexão: " . $conexao->connect_error);
    }
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
    echo $sql;

    if( $conexao->query($sql) === TRUE){
        $id = mysqli_insert_id($conexao);

        $sql2 = "INSERT INTO aluno (id_pessoa,username,senha) 
        VALUES ('$id','$username','$senha'); ";

        if($conexao->query($sql2)){
            echo 'Sucesso';
            require 'index.php';
        }else{
            echo 'erro';
        }

    }else{
        echo 'erro';
        }
    
        $conexao->close();
    ?>
</div>
