<?php
  $con_string = "host='localhost' port='5432' dbname='test_php' user='postgres' password='123'";

  $cpf = $_POST['cpf'];
  $nome = $_POST['nome'];
  $idade = $_POST['idade'];

  $cidade = $_POST['cidade'];
  $estado = $_POST['estado'];

  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $bairro = $_POST['bairro'];
  $cep = $_POST['cep'];

  $telefone = $_POST['telefone'];
    
  $con = pg_connect($con_string);

  $sql = "INSERT INTO pessoa (cpf, nome, idade) VALUES ('$cpf', '$nome', '$idade') RETURNING id";
  $result = pg_query($con, $sql);

  $linha = pg_fetch_row($result);
  $foreing = $linha[0];

  $sql = "INSERT INTO cidade (cidade, estado, id_pessoa) VALUES ('$cidade', '$estado', '$foreing')";
  pg_query($con, $sql);

  $sql = "INSERT INTO endereco (rua, numero, bairro, cep, id_pessoa) VALUES ('$rua', '$numero', '$bairro', '$cep', '$foreing')";
  pg_query($con, $sql);

  $sql = "INSERT INTO telefone (telefone, id_pessoa) VALUES ('$telefone', '$foreing')";
  pg_query($con, $sql);

  pg_close($con);

?>
