<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/fontawesome.min.css">
        <title>Primeiro Acesso - Site Agendas</title>
    </head>
    <body>
        
        <form action="Action.php" method="post"class="w3-container w3-card-4 w3-light-grey w3-text-blue w3-margin w3-round-large w3-display-middle" style="width: 30%;">
        <h2 class="w3-center">Primeiro Acesso</h2>

        <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%;">
        <i class="w3-xxlarge fa fa-user"></i>
        </div>
        <div class="w3-rest">
        <label class="w3-text-gray">Dados Pessoais</label>
            <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome">
            <input class="w3-input w3-border w3-round-large" name="txtSobrenome" type="text" placeholder="Sobrenome" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtData" type="date" placeholder="Data de Nascimento" style="margin-top: 5px;">
        </div>
        </div>

        <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%;">
        <i class="w3-xxlarge fas fa-id-card"></i>
        </div>
        <div class="w3-rest">
            <label class="w3-text-gray">Endereço</label>
            <input class="w3-input w3-border w3-round-large" name="txtLogradouro" type="text" placeholder="Logradouro">
            <input class="w3-input w3-border w3-round-large" name="txtNumero" type="text" placeholder="Número" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtComplemento" type="text" placeholder="Complemento" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtBairro" type="text" placeholder="Bairro" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtCidade" type="text" placeholder="Cidade" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtEstado" type="text" placeholder="Estado" style="margin-top: 5px;">
            <input class="w3-input w3-border w3-round-large" name="txtCEP" type="text" placeholder="CEP" style="margin-top: 5px;">
        </div>
        </div>


        <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%">
        <i class="w3-xxlarge fa fa-lock"></i>
        </div>
        <div class="w3-rest">
        <label class="w3-text-gray">Dados de Acesso</label>
            <input class="w3-input w3-border w3-round-large" name="txtUsuario" type="text" placeholder="Usuário">
            <input class="w3-input w3-border w3-round-large" name="txtSenha" type="password" placeholder="Senha" style="margin-top: 5px;">
        </div>
        </div>

        <div class="w3-row w3-section">
        <div class="w3-center" style="">
        <i class="w3-xxlarge fas fa-user-alt"></i>
            <button name="btnCadastrar" class="w3-button w3-block w3-margin w3-blue w3-cell w3-round-large" style="width: 90%;">Cadastrar</button>
        </div>
        </div>
        </form>

    </body>
</html>