<?php
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');




 $value_index=$_REQUEST['value_index'];
$sku=$_REQUEST['sku'];


 
	 
$productCollectionFactory = $obj->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');
$collection = $productCollectionFactory->create();
 $collection->addAttributeToFilter('sku', ['eq' => $sku])->load();
$prod=null;
      
   foreach($collection as $product)
       {
$prod = $obj->get('Magento\Catalog\Model\Product')->load($product->getId());
       
    
       }
$productTypeInstance = $obj->get('Magento\ConfigurableProduct\Model\Product\Type\Configurable');
$productAttributeOptions = $productTypeInstance->getConfigurableAttributesAsArray($prod);

$options=array();
foreach($productAttributeOptions as $option){
	
$options=$option["options"];
}




$response=array();


$label="";

for($i=0;$i<count($options);$i++){


if($options[$i]["value"]==$value_index)
{
   $response["code"]=200;
    $response["label"]=$options[$i]["label"];

}

}

if($response["code"]!=200)
$response["code"]=300;
header('Content-Type: application/json');

echo json_encode($response,true);




 


?>


