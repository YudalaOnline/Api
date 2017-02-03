<?php
use Magento\Framework\App\Bootstrap;
require __DIR__ . '/../app/bootstrap.php';
$bootstrap = Bootstrap::create(BP, $_SERVER);
$product_id=$_REQUEST['product_id'];
$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');
//$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
/** @var \Magento\Catalog\Model\ResourceModel\Product\Collection $productCollection */
$responses=array();
//$product = $objectManager->get('Magento\Catalog\Model\Product')->load($product_id);
$i=0;
$product = $objectManager->get('Magento\Catalog\Model\ProductFactory')->create()->load($product_id);
$cats = $product->getCategoryIds();
$cat_products = $objectManager->create('Magento\Catalog\Model\Category')->load($cats[0])->getProductCollection()->addAttributeToSelect('*')->addAttributeToFilter('status', array('eq' => 1))->joinField('qty',
'cataloginventory_stock_item',
'qty',
'product_id=entity_id',
'{{table}}.stock_id=1',
'left'
)->addAttributeToFilter('qty', array('gt' => 0))->setPageSize(5);
$products=array();
foreach ($cat_products  as $product) :
$record=array();
$record['image_path']=$product->getImage();
$record['name']=$product->getName();
$record['price']=intval($product->getPrice());
$record['special_price']=intval($product->getSpecialPrice());
$record['sku']=$product->getSku();
$record['id']=$product->getId();
$products[]=$record;
endforeach;

header('Content-type: application/json');
echo json_encode($products);
?>