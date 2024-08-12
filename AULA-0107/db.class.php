<?php

class db{

  private $host = "localhost";
  private $user = "root";
  private $pass = "";
  private $port = "3306";
  private $dbname = "db_pweb1_2024_1";

  function conn(){
    try{
        $conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->dbname",
          $this->user,
          $this->pass,
          [
            PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
          ]
        );

        return $conn;
  
    } catch(PDOException $e){
    echo "Erro: ". $e->getMessage();
    }
  }
  
  function insert($dados){
    //INSERT INTO aluno(nome,telefone,cpf)
    //VALUES ('Dudu','49 8497-5415','999.000.222-33');
   // var_dump($dados);
    //exit;

    $conn = $this->conn();
    $sql = "INSERT INTO aluno(nome,telefone,cpf) ";
    $sql .= "VALUES (?,?,?)";
    $st = $conn->prepare($sql);
    $st->execute([
        $dados['nome'],
        $dados['telefone'],
        $dados['cpf'],]);

  }

  function all(){
    $conn = $this->conn();
    $sql = "SELECT * FROM aluno";
    $st = $conn->prepare($sql);
    $st->execute();

    return $st->fetchAll(PDO::FETCH_CLASS);
  }

  function destroy($id){

    $conn = $this->conn();
    $sql = "DELETE FROM aluno WHERE id = ?";

    $st = $conn->prepare($sql);
    $st->execute([$id]);

  }

  function find($id){

    $conn = $this->conn();
    $sql = "SELECT * FROM aluno WHERE id = ?";

    $st = $conn->prepare($sql);
    $st->execute([$id]);

    return $st->fetchObject();

  }

  function update($dados){

    $conn = $this->conn();
    $sql = "UPDATE aluno SET nome=?, telefone=?, cpf=? WHERE id = ?";

    $st = $conn->prepare($sql);
    $st->execute([
      $dados['nome'],
      $dados['telefone'],
      $dados['cpf'],
      $dados['id'],  
    
    ]);

  }

}

?>