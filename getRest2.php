<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';



 $token=$_REQUEST['token'];
$endpoint=$_REQUEST['endpoint'];
 $method=$_REQUEST['method'];



$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method );

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token)); 
$result = curl_exec($ch);



   echo $result;


?>
