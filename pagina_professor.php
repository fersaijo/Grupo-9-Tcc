
<?php require_once('cabecalho.php'); ?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-top-right">
    <form action="Action.php" class="w3-container" method='post'>
        <button name="btnSair" class="w3-button w3-red w3-round-large w3-margin-right">
            <i class="w3-xxlarge fa fa-times-rectangle w3-margin"></i> Logout
        </button>
    </form>
</div>

<div class="w3-cotainer w3-padding w3-text-grey  w3-center" style="width:50%; margin:auto; display:block;">

    <?php
    session_start();
    require_once 'ConexaoBD.php';
    $conn = new ConexaoBD();
    $conexao = $conn->conectar();
    if( $conexao->connect_errno){
        die("Falha na conexão: " . $conexao->connect_error);
    }
    // Recuperando o nome do professor com base no login da sessão
    $login = $_SESSION['logado'];

    $sql = "SELECT * FROM  docente INNER JOIN pessoa p ON docente.id_pessoa = p.id WHERE docente.username = '$login'";
    
    $resultado = $conexao->query($sql);
    $professor = $resultado->fetch_assoc();
    $nome_professor = $professor['username'];

    // Exibindo o nome do professor na mensagem de boas-vindas
    echo "<h1 class='w3-center w3-teal w3-round-large w3-margin'>Bem-vindo, $nome_professor</h1>";
    ?>


    <div class="w3-row">
        <a href="cadastroQuestoes.php" class="w3-button w3-margin w3-margin-right w3-round-large w3-teal">
            Cadastrar Questões
        </a>
        <a href="listar.php" class="w3-button w3-margin w3-round-large w3-teal">
            Verificar notas
        </a>
        <a href="atualizarDados.php" class="w3-button w3-margin w3-round-large w3-teal">
           Atualizar dados
        </a>
    </div>
    <div class="w3-row">
    <h2 class="w3-center">Meus dados</h2>
        

        <div class="w3-row w3-section">
        <div class="w3-section">
        <i class="w3-xxlarge fa fa-user"></i>
        </div>
        <div class="w3-rest">
            <label class="w3-text-gray">Dados Pessoais</label>
                <input class="w3-input w3-border w3-round-large"  value="<?= $professor['nome'] ?>" readonly name="txtNome" type="text" placeholder="Nome">
                <input class="w3-input w3-border w3-round-large"  value="<?= $professor['sobrenome'] ?>" readonly name="txtSobrenome" type="text" placeholder="Sobrenome" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large"  value="<?= $professor['data_Nascimento'] ?>" readonly name="txtData" type="date" placeholder="Data de Nascimento" style="margin-top: 5px;">
            </div>
            </div>

            <div class="w3-row w3-section">
            <div class="w3-section" >
            <i class="w3-xxlarge fa fa-id-card"></i>
            </div>
            <div class="w3-rest">
                <label class="w3-text-gray">Endereço</label>
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['logradouro'] ?>" readonly name="txtLogradouro" type="text" placeholder="Logradouro">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['numero'] ?>" readonly name="txtNumero" type="text" placeholder="Número" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['complemento'] ?>" readonly name="txtComplemento" type="text" placeholder="Complemento" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['bairro'] ?>" readonly name="txtBairro" type="text" placeholder="Bairro" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['cidade'] ?>" readonly name="txtCidade" type="text" placeholder="Cidade" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['uf'] ?>" readonly name="txtEstado" type="text" placeholder="Estado" style="margin-top: 5px;">
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['cep'] ?>" readonly name="txtCEP" type="text" placeholder="CEP" style="margin-top: 5px;">
            </div>
            </div>


            <div class="w3-row w3-section">
            <div class="w3-section" >
            <i class="w3-xxlarge fa fa-lock"></i>
            </div>
            <div class="w3-rest">
            <label class="w3-text-gray">Dados de Acesso</label>
                <input class="w3-input w3-border w3-round-large" value="<?= $professor['username'] ?>" readonly name="txtUsuario" type="text" placeholder="Usuário">
                <input class="w3-input w3-border w3-round-large" hidden value="<?= $professor['senha'] ?>" readonly name="txtSenha" type="password" placeholder="Senha" style="margin-top: 5px;">
            </div>
            </div>
            
    </div>
</div>

<?php require_once('rodape.php'); ?>
