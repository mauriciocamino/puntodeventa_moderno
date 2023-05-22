<?php

function get_the_lang($lang_id)
{
	$statement = db()->prepare("SELECT * FROM `languages` WHERE `id` = ? OR `code` = ?"); 
	$statement->execute(array($lang_id, $lang_id));
	return $statement->fetch(PDO::FETCH_ASSOC);
}

function get_langs()
{
	$statement = db()->prepare("SELECT * FROM `languages`"); 
	$statement->execute(array());
	return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function trans($key)
{
	global  $language;
	return $language->get($key);
}


function trans_spa($key){
	$search  = array("complete",   "pending",   "sent" ,   "paid",  "due",    "purchase",  "deposit",    "withdraw",  "credit",    "gift card",  "bkash",  "sell","active");
	$replace = array("Completar", "Pendiente", "Expedido","Pagada","Pendiente", "Compra",  "Deposito",    "Retiro",  "Crédito",    "Tarjeta Regalo",  "Otros Metodos","Vendido","Activo");
 $state = str_ireplace($search, $replace, $key);
	return $state;
}

function trans_date($key){
	$search = array('January','February','March','April','May','June','July','August','September','Octubre','November','December','Mondays','Tuesdays','Wednesdays','Thursdays','Fridays','Saturdays','Sundays');
	$replace = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre",'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

	$state = str_ireplace($search, $replace, $key);

	$search = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Mon','Tue','Wed','Thu','Fri','Sat','Sun');
	$replace =array('Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul','Ago','Set', 'Oct', 'Nov', 'Dic','Lun','Mar','Mie','Jue','Vie','Sab','Dom');

	$state = str_ireplace($search, $replace, $state);
	return $state;
}

function trans_spa_table($key){
	$search  = array('bank_account_to_store','bank_accounts','bank_transaction_info','bank_transaction_price','box_to_store','boxes','brand_to_store','brands','category_to_store','categorys','currency','currency_to_store','customer_to_store','customer_transactions','customers','expense_categorys','expenses','gift_card_topups','gift_cards','holding_info','holding_item','holding_price','income_sources','installment_orders','installment_payments','language_translations','languages','loan_payments','loans','login_logs','mail_sms_tag','payments','pmethod_to_store','pmethods','pos_register','pos_template_to_store','pos_templates','printer_to_store','printers','product_images','product_to_store','products','purchase_info','purchase_item','purchase_logs','purchase_payments','purchase_price','purchase_return_items','purchase_returns','quotation_info','quotation_item','quotation_price','return_items','returns','sell_logs','selling_info','selling_item','selling_price','settings','shortcut_links','sms_schedule','sms_setting','stores','supplier_to_store','suppliers','taxrates','transfer_items','transfers','unit_to_store','units');
	$replace = array('cuenta bancaria para almacenar','cuentas bancarias','información de transacción bancaria','precio de transacción bancaria','caja para almacenar','cajas','marca para almacenar','marcas','categoría para almacenar','categorías','moneda','moneda para almacenar','cliente a almacenar','transacciones de clientes','clientes','categorías de gastos','gastos','recargas de tarjetas de regalo','tarjetas de regalo','sosteniendo información','elemento de sujeción','precio de tenencia','fuentes de ingresos','pedidos a plazos','pagos a plazos','traducciones de idiomas','idiomas','pagos de préstamos','préstamos','registros de inicio de sesión','etiqueta de correo sms','pagos','pmethod to store','pmethods','pos registro','plantilla pos para almacenar','plantillas pos','impresora para almacenar','impresoras','imágenes de producto','producto para almacenar','productos','información de compra','Adquirir artículo','registros de compra','pagos de compra','precio de compra','comprar artículos devueltos','devoluciones de compra','información de cotización','artículo de cotización','precio de cotización','devolver los artículos','devoluciones','vender troncos','venta de información','artículo de venta','precio de venta','configuración','enlaces de acceso directo','programación de sms','configuración de sms','historias','proveedor para almacenar','proveedores','las tasas de impuestos','transferir artículos','transferencias','unidad para almacenar','unidades');
 $state = str_ireplace($search, $replace, $key);
	return $state;
}