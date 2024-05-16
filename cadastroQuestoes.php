
<?php require_once ('cabecalho.php');

session_start();
require_once 'ConexaoBD.php';
$conn = new ConexaoBD();
$conexao = $conn->conectar();
if( $conexao->connect_errno){
    die("Falha na conexão: " . $conexao->connect_error);
}

// Recuperando o nome do professor com base no login da sessão
if(!isset($_SESSION['logado'])){
    echo 'Não logado';
}
$login = $_SESSION['logado'];

$sql = "SELECT disciplina FROM  docente INNER JOIN pessoa p ON docente.id_pessoa = p.id WHERE docente.username = '$login'";
    
$resultado = $conexao->query($sql);
$professor = $resultado->fetch_assoc();


?>
<a href="principal.php" class="w3-display-topleft">
    <i class="fa fa-arrow-circle-left w3-large w3-teal w3-button w3-xxlarge"></i>     
</a> 
<div class="w3-padding w3-content w3-text-grey w3-third w3-margin w3-display-middle">
        <h1 class="w3-center w3-teal w3-round-large w3-margin">Cadastro de questões</h1>
        <form action="cadastroAction.php" class="w3-container" method='post'>

            <label class="w3-text-teal" style="font-weight: bold;">Matéria</label>
            <input name="txtMateria" value="<?= $professor['disciplina']?>" class="w3-input w3-light-grey w3-border"><br>

            <label for="Agenda" class="w3-text-teal w3-label" style="font-weight: bold;"> Agenda</label>
            <input name="txtMateria"  class="w3-input w3-light-grey w3-border"><br>
            
            <label class="w3-text-teal" style="font-weight: bold;">Pergunta</label>
            <input name="txtPergunta" class="w3-input w3-light-grey w3-border"><br>
            
            <label class="w3-text-teal" style="font-weight: bold;">Opção 1 - Certa</label>
            <input name="txtOpcao1" class="w3-input w3-light-grey w3-border"><br>
            
            <label class="w3-text-teal" style="font-weight: bold;">Opção 2 - Errada</label>
            <input name="txtOpcao2" class="w3-input w3-light-grey w3-border"><br>
            
            <label class="w3-text-teal" style="font-weight: bold;">Opção 3 - Errada</label>
            <input name="txtOpcao3" class="w3-input w3-light-grey w3-border"><br>
            
            <label class="w3-text-teal" style="font-weight: bold;">Opção 4 - Errada</label>
            <input name="txtOpcao4" class="w3-input w3-light-grey w3-border"><br>

            <button name="btnAdicionar" class="w3-button w3-teal w3-cell w3-round-large w3-right w3-margin-right"> 
                <i class="w3-xxlarge fa fa-user-plus"></i> Adicionar
            </button>
        </form>
</div>
<?php require_once ('rodape.php'); ?>