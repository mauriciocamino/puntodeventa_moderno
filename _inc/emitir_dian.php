<?php 
ob_start();
session_start();
include ("../_init.php");

if (!is_loggedin()) {
	header('HTTP/1.1 422 Unprocessable Entity');
	header('Content-Type: application/json; charset=UTF-8');
	echo json_encode(array('errorMsg' => trans('error_login')));
	exit();
}

if ($_GET['type'] == 'fac_electronica') {
	$data   = $_POST;
	$item_m	= json_decode($data['items']);
	$venta		= json_decode($data['data']);

	foreach ($item_m as $k => $item) {
		$statement = db()->prepare("SELECT `p_code` FROM `products` WHERE `p_id` = ?");
		$statement->execute(array($item->item_id));
		$codigo = $statement->fetch(PDO::FETCH_ASSOC);
		$item->codigo = $codigo['p_code'];
	}

	$data['items'] = json_encode($item_m);
	$json 									= TransmitirDocumento($data);
	$rest									 = json_decode($json);

	if (!empty($rest->invoice->dian_status) && $rest->invoice->dian_status == 'DIAN_ACEPTADO') {
		$cufe = $rest->invoice->cufe;
		$estado =  'ok';
		$uuid   = $rest->invoice->uuid;
	}else{
		$cufe = '';
		$estado = 'error';
		$uuid   = '';
	}

	$resp   = str_replace("'","",json_encode($rest));
	$json   = $cufe."|*|".json_encode($json);

	$statement = db()->prepare("UPDATE `selling_info` SET `dian_json` = ?,`dian_estado` = ?,`dian_uuid` = ? WHERE `store_id` = ? and `invoice_id` = ?");
	$statement->execute(array($json,$estado,$uuid,$venta->store_id,$venta->invoice_id));
		echo json_encode($cufe);
		exit();
}

if ($_GET['type'] == 'TransmititFac') {

	$store_id = store_id();
	$user_id = user_id();

// LOAD INVOICE MODEL
	$invoice_model = registry()->get('loader')->model('invoice');
	$venta = $invoice_model->getInvoiceInfo($_POST['data']);

	$statement = db()->prepare("SELECT * FROM `selling_item` WHERE invoice_id = ?");
	$statement->execute(array($_POST['data']));
	$item_m = $statement->fetchAll(PDO::FETCH_ASSOC);

	$data = array('items' => $item_m, 'data' => json_encode($venta) );

foreach ($item_m as $k => $item) {		
		$statement = db()->prepare("SELECT `p_code` FROM `products` WHERE `p_id` = ?");
		$statement->execute(array($item['item_id']));
		$codigo = $statement->fetch(PDO::FETCH_ASSOC);
		$item_m[$k]['codigo'] = $codigo['p_code'];
	}

			

	$data['items'] = json_encode($item_m);
	$json 									= TransmitirDocumento($data);
	$rest									 = json_decode($json);

	if (!empty($rest->invoice->dian_status) && $rest->invoice->dian_status == 'DIAN_ACEPTADO') {
		$estado =  'ok';
		$uuid   = $rest->invoice->uuid;
		$msn    = "Factura emitida con exito!";
	}else{
		$estado = 'error';
		$uuid   = '';
		$msn    = "Error Transmitiendo la Factura!";
	}

	$resp   = str_replace("'","",json_encode($rest));
	$json   = $resp."|*|".json_encode($json);

	$statement = db()->prepare("UPDATE `selling_info` SET `dian_json` = ?,`dian_estado` = ?,`dian_uuid` = ? WHERE `store_id` = ? and `invoice_id` = ?");
	$statement->execute(array($json,$estado,$uuid,$store_id,$_POST['data']));
		echo json_encode($msn);
	exit();
}



if ($_GET['type'] == 'TransmitirNotaCredito') {
	$data_n    = explode('==', $_POST['data']);
	$mat_store = store();
	$store_id  = store_id();

	$statement = db()->prepare("SELECT sum(r.item_quantity)item_quantity , p.p_code from return_items r, products p  where r.item_id = p.p_id and store_id = ? and invoice_id = ? and created_at  is NULL GROUP by r.item_id");
	$statement->execute(array($store_id, $data_n[1]));
	$purchase_item = $statement->fetchAll(PDO::FETCH_ASSOC);

	$rest = TransmitirNotaCredito($mat_store,$purchase_item,$data_n[0]);

	if (!empty($rest->dian_status) && $rest->dian_status == 'DIAN_ACEPTADO') {
		$estado =  'ok';
		$uuid   =  $rest->uuid;
		$msn    = 'Nota Credito Generada con exito';

		$statement = db()->prepare("UPDATE `return_items` SET `created_at` = NOW() WHERE `store_id` = ? and `invoice_id` = ?");
		$statement->execute(array($store_id,$data_n[1]));
	}else{
		$estado = 'error';
		$uuid   = '';
		$msn = 'Error al generar la Nota Credito';
	}

	$resp   = str_replace("'","",json_encode($rest));
	$json   = $resp."|*|".json_encode($rest);

	$statement = db()->prepare("UPDATE `selling_info` SET `dian_json_nc` = ?,`dian_uuid_nc` = ?,`dian_estado_nc` = ? WHERE `store_id` = ? and `invoice_id` = ?");
	$statement->execute(array($json,$uuid,$estado,$store_id,$data_n[1]));

	echo json_encode($msn);
	exit();
}

function TransmitirDocumento($data){
	$json = array(
		'modulo' => 'api_dian',
		'metodo' => 'FacturaDian',
		'token' => 'eeb47ec90bdd90f51348badc0d601228d441ce77',
		'user' => 'admin',
		"venta" => $data['data'],
		"items" => $data['items'],
	);
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://app.miaccesoweb.com/rest.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $json,
	));

	$response = curl_exec($curl);
	curl_close($curl);

	return $response;
}

function TransmitirNotaCredito($mat_store,$purchase_item,$uuid){
	$json = array(
		'modulo'       => 'api_dian',
		'metodo'       => 'NotaCreditoDian',
		'token'        => 'eeb47ec90bdd90f51348badc0d601228d441ce77',
		'user'         => 'admin',
		"store"        => json_encode($mat_store),
		"uuid"         => $uuid,
		"items"        => json_encode($purchase_item),
	);

	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://app.miaccesoweb.com/rest.php',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => $json,
	));

	$json = curl_exec($curl);
	curl_close($curl);

	$rest = json_decode($json);
	return $rest;
}

