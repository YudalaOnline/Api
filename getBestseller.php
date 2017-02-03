<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
/** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
$productCollection = $objectManager->create('Magento\Sales\Model\ResourceModel\Report\Bestsellers\Collection');


		$productCollection->setPageSize(5);
 $responses=array();

foreach ($productCollection as $item){

  
$product = $objectManager->get('Magento\Catalog\Model\Product')->load($item->getProductId());
 $response=array();
$response['sku']= $product->getSku();
     $response['price']= intval($product->getPrice());
     $response['name']= $product->getName(); 
      $response['special_price']= intval($product->getSpecialPrice());
      $response['image_path']=  $product->getImage();
     
     $responses[]=$response;

}
header('Content-type: application/json');
	echo json_encode($responses,true);

?>