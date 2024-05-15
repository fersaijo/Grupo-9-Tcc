    <?php
    session_start();    
    
    
    require_once 'ConexaoBD.php';

    $conn = new ConexaoBD();
    $conexao = $conn->conectar();


    if ($conexao->connect_errno) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];
    
    $professor = $_POST['professor'];
    //se for on é professor
    if ($professor == 'on') {
        $sql = "SELECT * FROM pessoa p, docente WHERE docente.username =  '".$nome."';";
        $resultado = $conexao->query($sql);
        $linha = mysqli_fetch_array($resultado);
        if($linha != null)
        {
            if($linha['senha'] == $senha)
            {
                $_SESSION['logado'] = $nome;
                $_SESSION['id_pessoa'] = $linha['id_pessoa'];
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
                $_SESSION['id_pessoa'] = $linha['id_pessoa'];
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
