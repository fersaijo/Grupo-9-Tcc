<?php require_once ('cabecalho.php'); ?>
    <div class="w3-container w3-round-xxlarge w3-display-middle w3-card-4  w3-third " style="width: 50%;">

        <div class="w3-center">
            <br>
            <img src="img/logo geead.png" alt="GEEAD" style="width:100%" class="w3-container w3-margin-top">
        </div>

        <form class="w3-container " action="Action.php" method="post">
            <div class="w3-section">
                <label style="font-weight: bold;">Avaliações do curso de Desenvolvimento de sistemas - Questionários</label><br><br>
                <label style="font-weight: bold;">Usuário</label>
                <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="Digite o nome" name="txtNome" required>
                <label style="font-weight: bold;">Senha</label>
                <input class="w3-input w3-border w3-margin-bottom" type="password" placeholder="Digite a Senha" name="txtSenha" required>
                <input class="w3-check w3-border w3-margin-bottom" type="checkbox" name="professor" id="professor">
                <label style="font-weight: bold;" for="professor">Sou professor</label>
                <button class="w3-button w3-block w3-teal w3-section w3-padding" name="btnLogin" type="submit">Entrar</button>
                <a href="cadastroUsuario.php">Primeiro Acesso?</a>
            </div>
        </form>
        
        <br>
    
    </div>