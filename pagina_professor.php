
<?php require_once('cabecalho.php'); ?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-topright">
    <form action="logoutAction.php" class="w3-container" method='post'>
        <button name="btnLogout" class="w3-button w3-red w3-round-large w3-margin-right">
            <i class="w3-xxlarge fa fa-times-rectangle"></i> Logout
        </button>
    </form>
</div>

<div class="w3-padding w3-text-grey w3-half w3-display-middle w3-center">
    <?php
    session_start();
    require_once 'conexaoBD.php';

    // Recuperando o nome do professor com base no login da sessão
    $login = $_SESSION['logado'];
    $sql = "SELECT nome FROM professores WHERE login = '$login'";
    $resultado = $conexao->query($sql);
    $professor = $resultado->fetch_assoc();
    $nome_professor = $professor['nome'];

    // Exibindo o nome do professor na mensagem de boas-vindas
    echo "<h1 class='w3-center w3-teal w3-round-large w3-margin'>Bem-vindo, $nome_professor</h1>";
    ?>

    <div class="w3-row">
        <a href="cadastro.php" class="w3-button w3-margin-bottom w3-margin-right w3-round-large w3-teal">
            Cadastrar Questões
        </a>
        <a href="listar.php" class="w3-button w3-margin-bottom w3-round-large w3-teal">
            Verificar notas
        </a>
    </div>
</div>

<?php require_once('rodape.php'); ?>
