<?php

ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


 $resource = \Magento\Framework\App\ObjectManager::getInstance()
        ->get('Magento\Framework\App\ResourceConnection');
    $connection= $resource ->getConnection();
	

	 $result = $connection->rawQuery("SELECT DISTINCT eaov.value
FROM eav_attribute ea
LEFT JOIN eav_attribute_option eao ON eao.attribute_id = ea.attribute_id
LEFT JOIN eav_attribute_option_value eaov ON eaov.option_id = eao.option_id
WHERE ea.attribute_code =  'brand'");
      $responses=array();
   foreach($result as $res)
       {
      $response=array();

    
      $responses[]=$res['value'];
       }
	 

echo json_encode($responses,true);



?>
