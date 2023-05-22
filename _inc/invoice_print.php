<?php 
ob_start();
session_start();
include ("../_init.php");

// Check, if user logged in or not
// If user is not logged in then return an alert message
if (!is_loggedin()) {
  header('HTTP/1.1 422 Unprocessable Entity');
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array('errorMsg' => trans('error_login')));
  exit();
}

$invoice_id    = $_POST['id'];
$stores        = $_POST['store'];
$invoice_model = registry()->get('loader')->model('invoice');
$invoice_info  = $invoice_model->getInvoiceInfo($invoice_id);

$cufe = explode('|*|', $invoice_info['dian_json']);
$invoice_items = $invoice_model->getInvoiceItems($invoice_id);
$data = array('data' => $invoice_info,'punto_b'=> $stores,'items' =>$invoice_items,'cufe'=>$cufe[0]);

echo json_encode($data);
exit();