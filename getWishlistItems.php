<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$customer_id=$_REQUEST['customer_id'];


$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


$wishlist  = $objectManager->get('Magento\Wishlist\Model\WishlistFactory')->create()->loadByCustomerId($customer_id, true);



$wishListItemCollection = $wishlist->getItemCollection();
 $responses= array();
foreach ($wishListItemCollection as $item)
{

$product =  $objectManager->get('Magento\Catalog\Model\Product')->load($item->getProductId());
  
     $response=array();
$response['item_id']= $item->getId();
$response['sku']= $product->getSku();
     $response['price']= intval($item->getPrice());
     $response['name']= $item->getName(); 
         $response['image_path'] =  $product->getImage();

     
     $responses[]=$response;



}


 header('Content-type: application/json');
   echo json_encode($responses);

?>