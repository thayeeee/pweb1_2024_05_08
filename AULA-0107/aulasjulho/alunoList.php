<?php
  include './aula2907_funcao.php';
  include "../db.class.php";


  head();

  $db = new db();
  $db->conn();
    
  $dados = $db->all();

  //var_dump($dados);
  //exit;

?>
<div class="col">
  <h3>LISTAGEM DE ALUNOS</h3>

    <div class="container-fliud">
      <form class="d-flex" role="search">

        <div class="col-4 px-3">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Search">
        </div>

        <div class="col-4 px-2">
          <button class="btn btn-outline-success" type="submit">Pesquisar</button>
          <a class="btn btn-outline-primary" href="./alunoForm.php">Cadastrar</a>
        </div>
      </form>
    </div>
    
  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Email</th>
        <th scope="col">Telefone</th>
      </tr>
    </thead>
    
    <tbody>
      <?php
        foreach($dados as $item){
          //var_dump($dados);
          //exit;
          echo"<tr>
                  <th scope='row'>$item->id</th>
                  <td>$item->nome</td>
                  <td>$item->cpf</td>
                  <td>$item->telefone</td>
                </tr>";
        }
      ?>
    </tbody>
  </table>
</div>



<?php

footer();

?>

