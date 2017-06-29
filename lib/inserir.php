<?php
  	$con_string = "host='localhost' port='5432' dbname='test_php' user='postgres' password='123'";
  	$con = pg_connect($con_string);

  	$data = json_encode(file_get_contents("php://input"));
  	print($data);
  	printf("asgasg");

  	if(count($data) > 0){
  	
  		$p_nome = $data->nome;
  		$p_cpf = $data->cpf;
  		$p_idade = $data->idade;


  		$con = pg_connect($con_string);

  		$sql = "INSERT INTO pessoa (cpf, nome, idade) VALUES ('000.000.000-00', '$p_nome', '20')";
  		$result = pg_query($con, $sql);

  		if($result)
  			echo "Dado inserido";
  		else
  			echo "Erro";
  	}
 ?>