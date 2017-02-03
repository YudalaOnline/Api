<?php

use Magento\Framework\App\Bootstrap;
require __DIR__ . '/../app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$id=$_REQUEST['id'];
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$object_manager = $_objectManager->create('Magento\Catalog\Model\Category')->load($id)->getProductCollection()->addAttributeToSelect('*')->addAttributeToFilter('status', array('eq' => 1))->joinField('qty',
         'cataloginventory_stock_item',
         'qty',
         'product_id=entity_id',
         '{{table}}.stock_id=1',
         'left'
     )->addAttributeToFilter('qty', array('gt' => 0))->setPageSize(30);


$products=array();
foreach ($object_manager as $product) :
$record=array();
$record['image_path']=$product->getImage();
$record['name']=$product->getName();
$record['price']=intval($product->getPrice());
$record['sku']=$product->getSku();
$record['special_price']=intval($product->getSpecialPrice());
$record['id']=$product->getId();

$products[]=$record;
endforeach;
header('Content-type: application/json');
echo json_encode($products);

?>