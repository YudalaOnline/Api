<?php

ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');




$skuList=$_REQUEST['sku'];
 $skus = explode(',', $skuList); 
   $responses=array(); 
foreach($skus as $sku) {
	 
$productCollectionFactory = $obj->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$collection = $productCollectionFactory->create();
 $collection->addAttributeToFilter('sku', ['eq' => $sku])->load();

      
   foreach($collection as $product)
       {
$product = $obj->get('Magento\Catalog\Model\Product')->load($product->getId());
  
     $response=array();
$response['sku']= $product->getSku();
$response['name']= $product->getName();
     $response['price']= intval($product->getPrice());
$response['special_price']= $product->getSpecialPrice();
$response['special_from_date']= $product->getSpecialFromDate();
$response['special_to_date']= $product->getSpecialToDate();
$response['url']= $product->getUrlKey();
;

     
     $responses[]=$response;
       }
  
  }
header('Content-Type: application/json');
echo json_encode($responses,true);



?>
