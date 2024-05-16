<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Atualizar dados</title>
</head>
<body>

    <?php
    session_start();
    require_once 'ConexaoBD.php';
    $conn = new ConexaoBD();
    $conexao = $conn->conectar();
    if( $conexao->connect_errno){
        die("Falha na conexão: " . $conexao->connect_error);
    }

    // Recuperando o nome do aluno com base no login da sessão
    $login = $_SESSION['logado'];
    $sql = "SELECT * FROM  docente INNER JOIN pessoa p ON docente.id_pessoa = p.id WHERE docente.username = '$login'";
    $resultado = $conexao->query($sql);
    $aluno = $resultado->fetch_assoc();
    $nome_aluno = $aluno['username'];

    // Exibindo o nome do aluno
    
    ?>

<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-top-right">
    <form action="Action.php" class="w3-container" method='post'>
        <button name="btnVoltarAluno" class="w3-button w3-red w3-round-large w3-margin-right">
            <i class="w3-xxlarge fa fa-times-rectangle w3-margin"></i> Logout
        </button>
    </form>
</div>

<div class="w3-cotainer w3-padding w3-text-grey  w3-center" style="width:50%; margin:auto; display:block;">
    <div class="w3-row w3-margin">
    <h1 class='w3-center w3-teal w3-round-large w3-margin'>Atualizar os dados do usuário</h1>
    </div>
    <div class="w3-row">
        <form action="Action.php" method="post">
    <h2 class="w3-center">Meus dados</h2>
        

        <div class="w3-row w3-section">
        <div class="w3-section">
        <i class="w3-xxlarge fa fa-user"></i>
        </div>
        <div class="w3-rest">

        
        <label class="w3-text-gray">Dados Pessoais</label>
            <input class="w3-input w3-border w3-round-large"  value="<?= $aluno['nome'] ?>"  name="txtNome" type="text" placeholder="Nome">
            <input class="w3-input w3-border w3-round-large"  value="<?= $aluno['sobrenome'] ?>"  name="txtSobrenome" type="text" placeholder="Sobrenome" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large"  value="<?= $aluno['data_Nascimento'] ?>"  name="txtData" type="date" placeholder="Data de Nascimento" style="margin-top: 5px;">
        </div>
        </div>

        <div class="w3-row w3-section">
        <div class="w3-section" >
        <i class="w3-xxlarge fa fa-id-card"></i>
        </div>
        <div class="w3-rest">
            <label class="w3-text-gray">Endereço</label>
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['logradouro'] ?>"  name="txtLogradouro" type="text" placeholder="Logradouro">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['numero'] ?>"  name="txtNumero" type="text" placeholder="Número" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['complemento'] ?>"  name="txtComplemento" type="text" placeholder="Complemento" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['bairro'] ?>"  name="txtBairro" type="text" placeholder="Bairro" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['cidade'] ?>"  name="txtCidade" type="text" placeholder="Cidade" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['uf'] ?>"  name="txtEstado" type="text" placeholder="Estado" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['cep'] ?>"  name="txtCEP" type="text" placeholder="CEP" style="margin-top: 5px;">
        </div>
        </div>


        <div class="w3-row w3-section">
        <div class="w3-section" >
        <i class="w3-xxlarge fa fa-lock"></i>
        </div>
        <div class="w3-rest">
        <label class="w3-text-gray">Dados de Acesso</label>
            <input class="w3-input w3-border w3-round-large" value="<?= $aluno['username'] ?>"  name="txtUsuario" type="text" placeholder="Usuário">
            <input class="w3-input w3-border w3-round-large" hidden value="<?= $aluno['senha'] ?>"  name="txtSenha" type="password" placeholder="Senha" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" hidden value="<?= $aluno['id'] ?>"  name="txtId" type="text" placeholder="Senha" style="margin-top: 5px;">
        </div>
        </div>
        
            <button class="w3-cyan w3-button" name="btnAtualizarDados">Atualizar dados</button>
        </form>
    </div>
</div>

</body>
</html>