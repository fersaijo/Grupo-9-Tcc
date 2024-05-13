<?php require_once ('cabecalho.php'); ?>
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

    if ($professor == 'on') {
        $sql = "SELECT * FROM docente WHERE username =  '".$nome."';";
        $resultado = $conexao->query($sql);
        $linha = mysqli_fetch_array($resultado);
        if($linha != null)
        {
            if($linha['senha'] == $senha)
            {
                $_SESSION['logado'] = $nome;
                header("Location: pagina_professor.php");
            }
            else
            {
                    echo '
                    <a href="index.php">
                        <h1 class="w3-button w3-teal">Dados inválidos! </h1>
                    </a> 
                    ';
            }
            }
            else
            {
                echo '
                <a href="index.php">
                    <h1 class="w3-button w3-teal">Login Inválido! </h1>
                </a> 
                ';
            }
            
    }else{// ser for aluno
        $sql = "SELECT * FROM aluno WHERE username =  '".$nome."';";
        $resultado = $conexao->query($sql);
        echo "works";
        $linha = mysqli_fetch_array($resultado);
        if($linha != null)
        {
            if($linha['senha'] == $senha)
            {
                $_SESSION['logado'] = $nome;
                header("Location: pagina_aluno.php");
            }
            else
            {
                    echo '
                    <a href="index.php">
                        <h1 class="w3-button w3-teal">Login Inválido! </h1>
                    </a> 
                    ';
            }
        }
        else
        {
            echo '
            <a href="index.php">
                <h1 class="w3-button w3-teal">Login Inválido! </h1>
            </a> 
            ';
        }
    }
    
        $conexao->close();
    ?>
</div>
<?php require_once ('rodape.php'); ?>