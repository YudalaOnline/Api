<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
 $token=$_REQUEST['token'];
$endpoint=$_REQUEST['endpoint'];
 $method=$_REQUEST['method'];
$sku=$_REQUEST['sku'];
$qty=$_REQUEST['qty'];
$quote_id=$_REQUEST['quote_id'];
$data=array('sku'=>$sku,'qty'=>$qty,'quote_id'=>$quote_id);
$itemData=array('cartItem'=>$data);
$body = json_encode($itemData);


$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method );
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);                                                                  

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer " . $token)); 
$result = curl_exec($ch);

$result2=json_decode($result,true);


 $repo = $obj->get('Magento\Catalog\Model\ProductRepository');
  $product= $repo->get($sku);   
$result2['image_path']=$product->getImage();
   echo json_encode($result2);


?>
