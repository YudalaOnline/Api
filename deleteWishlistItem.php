<?php
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$item_id=$_REQUEST['item_id'];


$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


$itemFactory= $objectManager->get('Magento\Wishlist\Model\ItemFactory');

$wishlistProviderInterface= $objectManager->get('Magento\Wishlist\Controller\WishlistProviderInterface');


$item=$itemFactory->create()->load($item_id);
if (!$item->getId()) {
  $record['msg']='Item not found';
 
   echo json_encode($record);
return;

}


$wishlist  = $objectManager->get('Magento\Wishlist\Model\WishlistFactory')->create()->load($item->getWishlistId());

if (!$wishlist) {
  $record['msg']='Wishlist not found';
      echo json_encode($record);
return;
}
try {
    $item->delete();
    $wishlist->save();
 $record['msg']='Item successfully removed from wishlist';
      echo json_encode($record);
return;

} catch (Exception $e) {
 $record['msg']='Wishlist not found';
      echo json_encode($record);
return;


}
?>