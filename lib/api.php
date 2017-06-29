<?php
   
  // get the HTTP method, path and body of the request
  $method = $_SERVER['REQUEST_METHOD'];
  $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
  $input = json_decode(file_get_contents('php://input'),true);
   

  // connect to the mysql database
  $link = pg_connect("host='localhost' port='5432' dbname='test_php' user='postgres' password='123' ");
  pg_set_client_encoding($link, 'UTF8');

  // retrieve the table and key from the path
  $table = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
  $key = array_shift($request)+0;
   
  // escape the columns and values from the input object
  $columns = preg_replace('/[^a-z0-9_]+/i','',array_keys($input));

  $values = array_map(function ($value) use ($link) {
    if ($value===null) return null;

    return pg_escape_string($link,(string)$value);

  },array_values($input));
   

  // create SQL based on HTTP method
  switch ($method) {
    case 'GET':
      $sql = "select * from $table".($key?" WHERE id=$key":''); break;
  }
   
  // excecute SQL statement
  $result = pg_query($link,$sql);
   
  // die if SQL statement failed
  if (!$result) {
    http_response_code(404);
    die(pg_result_error());
  }
   
  // print results, insert id or affected row count
  if ($method == 'GET') {
    if (!$key) echo '[';
    for ($i=0;$i<pg_numrows($result);$i++) {
      echo ($i>0?',':'').json_encode(pg_fetch_object($result));
    }
    if (!$key) echo ']';
  }
   
  pg_close($link);

?>
