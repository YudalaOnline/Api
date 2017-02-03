<?php

ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$attribute_id=$_REQUEST['attribute_id'];
  
    
	 
$productCollectionFactory = $obj->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$collection = $productCollectionFactory->create();
 $collection->addAttributeToFilter('brand', ['eq' => $attribute_id])->joinField('qty',
'cataloginventory_stock_item',
'qty',
'product_id=entity_id',
'{{table}}.stock_id=1',
'left'
)->addAttributeToFilter('qty', array('gt' => 0))->load();

       $responses=array();
   foreach($collection as $product)
       {
$product = $obj->get('Magento\Catalog\Model\Product')->load($product->getId());
  
     $response=array();
$response['sku']= $product->getSku();
     $response['price']= intval($product->getPrice());
      $response['special_price']= intval($product->getSpecialPrice());
     $response['name']= $product->getName(); 
         $response['image_path'] =  $product->getImage();

     
     $responses[]=$response;
       }
  header('Content-type: application/json');
  
echo json_encode($responses,true);



?>
