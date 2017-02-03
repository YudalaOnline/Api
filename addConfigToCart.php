<?php
ini_set("display_errors",1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$congigurableProductId=$_REQUEST['config_product_id'];
$product_id=$_REQUEST['simple_product_id'];
$quote_id=$_REQUEST['quote_id'];
$qty=$_REQUEST['qty'];

$objectManager  = $bootstrap->getObjectManager();
$state = $objectManager->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');



$productRepository= $objectManager->get('Magento\Catalog\Api\ProductRepositoryInterface');
try {
    $configProduct = $productRepository->getById($congigurableProductId);
    $simpleProduct= $productRepository->getById($product_id);
} catch (NoSuchEntityException $e) {
    $product = null;
    $record['msg']='Item could not be added to cart';
}

$cart = $objectManager->get('Magento\Checkout\Model\Cart');




try{
// Add configurable product to cart
	$productAttributeOptions = 
	 $configProduct->getTypeInstance(true)->getConfigurableAttributesAsArray($configProduct);
    $options = array();
	foreach ($productAttributeOptions as $productAttribute) {
        $allValues = array_column($productAttribute['values'], 'value_index');
       
        $currentProductValue = $simpleProduct->getData($productAttribute['attribute_code']);
        if (in_array($currentProductValue, $allValues)) {
            $options[$productAttribute['attribute_id']] = $currentProductValue;
        }
    }




$params = array(
        'product' => $simpleProduct->getId(),
        'qty' => $qty,
        'super_attribute' => $options
    );
   

   $request = new \Magento\Framework\DataObject();
 $request->setItem($params);
  
   echo  $cart->addProduct($configProduct,$request);
   
    
    $session = $objectManager->create('Magento\Customer\Model\Session');
    $session->setCartWasUpdated(true);
    
 
// Save cart
$cart->save(); 
$record['msg']='Item succesfully added to cart';
foreach($quote->getAllItems() as $item)
echo $item->getSku();
 
   echo json_encode($record);

}catch(Exception $e){

 $record['msg']='Item could not be added to cart';
 var_dump($e->getMessage());
   echo json_encode($record);
}


?>