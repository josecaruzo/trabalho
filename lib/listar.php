<?php 
 
 	$con_string = "host='localhost' port='5432' dbname='test_php' user='postgres' password='123'";
 	$con = pg_connect($con_string);
 	pg_setclientencoding("UTF-8");
 	echo "<meta charset='utf-8'>";	
		

 	$sql = "SELECT * FROM pessoa ORDER BY cpf";
 	$pessoas = pg_query($con, $sql);

 	$res = array();


 	echo "<pre>[";
 		echo "<br>";
 	$i = 0;
	while($pe = pg_fetch_assoc($pessoas)){

		$foreing = $pe['id'];

		$sql = "SELECT * FROM cidade WHERE id_pessoa = '$foreing' ";
 		$cidade = pg_query($con, $sql);
 		$ci = pg_fetch_assoc($cidade);

 		$sql = "SELECT * FROM endereco WHERE id_pessoa = '$foreing' ";
 		$endereco = pg_query($con, $sql);
 		$end = pg_fetch_assoc($endereco);
 
 		$sql = "SELECT * FROM telefone WHERE id_pessoa = '$foreing' ";
 		$telefone = pg_query($con, $sql);
 		$res_tel = array();
 		while($tel = pg_fetch_assoc($telefone)){
 			$res_tel[] = $tel['telefone'];
 		}
 

		
		array_push($res, array(
			'cpf' => $pe['cpf'], 
			'nome' => $pe['nome'], 
			'idade' =>$pe['idade'],
			'cidade' => $ci['cidade'], 
			'estado' => $ci['estado'],
			'rua' => $end['rua'],
			'numero' => $end['numero'],
			'bairro' => $end['bairro'],
			'cep' => $end['cep'],
			'telefone' =>$res_tel
		));  		

		echo "<br>";
		echo ($i == 0? '': ',') . json_encode($res[$i], JSON_PRETTY_PRINT);
		$i++;

 	}
	
	/*
 	
 	*/

 	echo "]</pre>";

 	pg_close($con);
?>