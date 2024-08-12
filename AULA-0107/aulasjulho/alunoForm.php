<?php

include "./aula2907_funcao.php";
include "../db.class.php";


head();

$db = new db();
$db->conn();

if(!empty($_POST)){
 // var_dump($_POST);
 // exit;
  $db->insert([
    'nome' => $_POST['nome'],
    'telefone' => $_POST['telefone'],
    'cpf' => $_POST['cpf'],
  ]);
}

if (!empty($_GET['id'])){
  $data = $db->find($_GET['id']);
  var_dump($data);
  exit;
}

?>

<div class="col">

  <form action="alunoForm.php" method="POST">

    <h3>FORMULÁRIO ALUNO</h3>
      
      <div class="mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" 
        class="form-control" 
        value="<?php echo !empty ($data->nome) ? $data->nome : "" ?>"
        name="nome" require placeholder="Nome">
      </div>
      
      
      <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="cpf" class="form-control" value="<?php echo !empty ($data->cpf) ? $data->cpf : "" ?>" name="cpf" require placeholder="000.000.000-00">
      </div>
      
      
      <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" value="<?php echo !empty ($data->telefone) ? $data->telefone: "" ?>"name="telefone" require placeholder="(00)0 0000-0000">
      </div>

      <button type="submit"
        class="btn btn-success">Salvar</button>
      <a class="btn btn-primary" href="../index.php">Voltar</a>

  </form>
</div>


<?php
  footer();
?>