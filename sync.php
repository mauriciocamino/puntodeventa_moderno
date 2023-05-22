<?php
require_once("config.php");
require_once("_inc/helper/common.php");
require_once("_inc/helper/file.php");
require_once("_inc/helper/network.php");




function validateApiAccess($username, $password) {
    $valid_clients = array(
        'itsolution24' => array(
            'password' => '1993'
        ),
    );
    return isset($valid_clients[$username]) && ($valid_clients[$username]['password'] == $password);
}

$post_data 		= json_decode(file_get_contents('php://input'), true);
$action 		= isset($post_data['action']) ? $post_data['action'] : null;
$query_data 	= isset($post_data['data']) ? json_decode($post_data['data'],true) : null;

if (!isset($post_data['username']) || !isset($post_data['password'])) {
    echo json_encode(array(
		'status' => 'error',
		'message' => 'Acción no válida 2',
		'for' => 'invalid',
	));
    exit();
}

if (!validateApiAccess($post_data['username'], $post_data['password'])) {
    echo json_encode(array(
		'status' => 'error',
		'message' => 'Acción no válida 3',
		'for' => 'invalid',
	));
    exit();
}


switch ($action) {
	case 'sync':
	    
		
		try {
    		$db = pdo_start();
    	}
    	catch(PDOException $e) {
    		 echo json_encode(array(
        		'status' => 'error',
        		'message' => 'Error de conexión a la base de datos: '.$e->getMessage(),
        		'for' => 'invalid',
        	));
            exit();
    	}

	    foreach ($query_data as $sql) {
	      $statement = $db->prepare($sql['sql']);
	      $statement->execute($sql['args']);
	    }

		echo json_encode(array(
			'status' => 'success',
			'message' => 'sincronización realizada correctamente',
			'for' => 'sync',
		));
		break;

	default:
		echo json_encode(array(
			'status' => 'error',
			'message' => 'Acción no válida 4',
			'for' => 'invalid',
		));
		break;
}
