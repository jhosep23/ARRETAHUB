<?php 
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;


$app->get('/api/clientes', function (Request $request, Response $response) {
    
    $statement = "Select * from usuarios";

    $db = new conectionDB();

	try {

		$conexion = $db->conexion(); 
		$consulta = $conexion->query($statement);

		if ($consulta->rowCount() < 1){
		echo "No existen clientes en la base de datos";	
		}else{

			$clientes = $consulta->fetchAll(PDO::FETCH_OBJ);
			
			$db = null;
			
			echo json_encode($clientes);
			
		}
	} catch (PDOException $e) {
		echo '{"error" : {"text":"'.$e->getMenssage().'"}';
	}
});

//obtener un cliente 
$app->get('/api/clientes/{id}', function (Request $request, Response $response) {

    $db = new conectionDB();
    $conexion = $db->conexion(); 

	$id_cliente = $request->getAttribute("id");

	try {
			
			$statement = $conexion->prepare("Select * from usuarios WHERE id = ?");
			
			$statement->bindParam(1, $id_cliente);

			$statement->execute();

			if ($statement->rowCount() < 1){

		echo "No existen clientes en la base de datos";	

		}else{

			$clientes = $statement->fetchAll();

			$db = null;

			echo json_encode($clientes);
			
		}
	} catch (PDOException $e) {
		echo '{"error" : {"text":"'.$e->getMenssage().'"}';
	}
});

$app->post('/api/clientes/registro', function (Request $request, Response $response) {

	$nombre = $request->getParam("nombre");
	$apellido = $request->getParam("apellido");

	$db = new conectionDB();
    $conexion = $db->conexion(); 

   try {
    	
    	$statement = $conexion->prepare("INSERT INTO usuarios (nombre,apellido) VALUES (:nombre,:apellido)");

		$statement->execute([':nombre' => $nombre, 
							':apellido' => $apellido]);

		echo "¡ cliente registrado ! ";

    } catch (Exception $e) {
	
	echo "Es imposible registrar este usuario, intente mas tarde ";

    }

//

});

 ?>