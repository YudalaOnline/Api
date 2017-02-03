<?php
$token=$_REQUEST['token'];
$endpoint=$_REQUEST['endpoint'];
$sku=$_REQUEST['sku'];
$qty=$_REQUEST['qty'];
$quoteID=$_REQUEST['quoteID'];
$api_request_parameters = array(
  'sku' =>$sku,
  'qty' => $qty,
  'quote_id' => $quoteID
);
 


$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,'PUT' );
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($api_request_parameters));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:	 application/json", "Authorization: Bearer " . $token)); 
$result = curl_exec($ch);
echo $result;
?>