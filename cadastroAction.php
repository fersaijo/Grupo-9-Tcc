<?php require_once ('verificarAcesso.php'); ?>
<?php require_once ('cabecalho.php'); ?>
<div class="w3-padding w3-content w3-text-grey w3-third w3-display-middle">
    <?php
        require_once 'conexaoBD.php';
        $sql = "INSERT INTO Questões (materia, pergunta, opcao1, opcao2, opcao3, opcao4)
        VALUES ('".$_POST['txtMateria']."', '".$_POST['txtPergunta']."', '".$_POST['txtOpcao1']."', '".$_POST['txtOpcao2']."', '".$_POST['txtOpcao3']."', '".$_POST['txtOpcao4']."')";
     
        if ($conexao->query($sql) === TRUE) {
            echo '
            <a href="pagina_professor.php">
                <h1 class="w3-button w3-teal">Questão Salva com sucesso! </h1>
            </a> 
            ';
            
        } else {
            echo '
            <a href="pagina_professor.php">
                <h1 class="w3-button w3-teal">ERRO! </h1>
            </a> 
            ';
        }
        $conexao->close();
    ?>
</div>
<?php require_once ('rodape.php'); ?>