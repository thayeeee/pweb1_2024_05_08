<?php

class db {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $port = "3306";
    private $dbname ="banco_thay";

    function conn(){

        try{
            $conn = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname",
                $this->user,
                $this->password,
                [
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION,
                    PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8"
                ]
            );

            return $conn;

        } catch(PDOException $e){
            echo "Erro: ". $e->getMessage();
        }
    }

    function insert($dados){
        // INSERT INTO aluno(nome,telefone,cpf) 
	    // VALUES ('Maria','49 8800-5501','002.555.000-11');
	
        //var_dump($dados); //retorna o valor da variavel
        //exit; //para a execução do codigo-fonte
        $conn = $this->conn();

        $sql = "INSERT INTO aluno(nome,telefone,cpf) ";

        $sql .= "VALUES (?,?,?)";

        $st = $conn->prepare($sql);
        
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf']
        ]);

    }

    function all(){
     
        $conn = $this->conn();
        $sql = "SELECT * FROM aluno";

        $st = $conn->prepare($sql);
        $st->execute();

        return $st->fetchAll(PDO::FETCH_CLASS);
    }

    function destroy($id){
       // var_dump($id);
       // exit;
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
        $sql = "UPDATE aluno SET
              nome=?, telefone=?, cpf=?
              WHERE id = ?";

        $st = $conn->prepare($sql);
        $st->execute([
            $dados['nome'],
            $dados['telefone'],
            $dados['cpf'],
            $dados['id'],
        ]);

        return $st->fetchObject();
    }
    function search($data){


   //   var_dump($data);
    //  exit;
      $tipo = $data['tipo'];
      $valor = $data['valor'];
     
      $conn = $this->conn();
      $sql = "SELECT * FROM aluno WHERE $tipo LIKE ?";

      $st = $conn->prepare($sql);
      $st->execute(["%$valor%"]);

      return $st->fetchAll(PDO::FETCH_CLASS);
  }
  function login($data){

    //   var_dump($data);
     //  exit;
      
       $conn = $this->conn();
       $sql = "SELECT * FROM aluno WHERE cpf LIKE ?";
 
       $st = $conn->prepare($sql);
       $st->execute([$dat['cpf']]);
 
      $result = $st->fetchObject();

      if(password_verify($data['senha'], $result -> senha)){
        return $result;
      } else {
        return "Erro";
      }

   }
  
}

?>