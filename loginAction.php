<?php require_once ('cabecalho.php'); ?>
<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle" >
    <?php
    session_start();    
    $nome = $_POST['txtNome'];
    $senha = $_POST['txtSenha'];
       require_once 'conexaoBD.php';
       $sql = "SELECT * FROM usuario WHERE nome =  '".$nome."';";
       $resultado = $conexao->query($sql);
       //echo $sql;
       $linha = mysqli_fetch_array($resultado);
       if($linha != null)
        {
            if($linha['senha'] == $senha)
            {
                $_SESSION['logado'] = $nome;
                if($linha['tipo'] == 'professor') {
                    header("Location: pagina_professor.php");
                } else if($linha['tipo'] == 'aluno') {
                    header("Location: pagina_aluno.php");
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
        else
        {
            echo '
            <a href="index.php">
                <h1 class="w3-button w3-teal">Login Inválido! </h1>
            </a> 
            ';
        }
        $conexao->close();
    ?>
</div>
<?php require_once ('rodape.php'); ?>