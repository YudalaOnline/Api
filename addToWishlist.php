<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$customer_id=$_REQUEST['customer_id'];
$product_id=$_REQUEST['product_id'];

$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


$productRepository= $objectManager->get('Magento\Catalog\Api\ProductRepositoryInterface');
try {
    $product = $productRepository->getById($product_id);
} catch (NoSuchEntityException $e) {
    $product = null;
}

$wishlist  = $objectManager->get('Magento\Wishlist\Model\WishlistFactory')->create()->loadByCustomerId($customer_id, true);

try{
$wishlist->addNewItem($product);
$wishlist->save();
$record['msg']='Item succesfully added to wishlist';
 
   echo json_encode($record);

}catch(Exception $e){

 $record['msg']='Item not added to wishlist,retry later.';
 
   echo json_encode($record);
}


?>