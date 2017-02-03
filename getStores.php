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
	

	 $result = $connection->rawQuery("SELECT storelocator_id,address,city,description,email,phone,state,store_name FROM magestore_storelocator_store");
      $responses=array();
   foreach($result as $res)
       {
      $response=array();
          $response['id']=$res['storelocator_id'];
     $response['address']=$res['address'];
     $response['city']=$res['city'];
     $response['description']=$res['description'];
     $response['email']=$res['email'];
      $response['phone']=$res['phone'];
      $response['state']=$res['state'];
      $response['store_name']=$res['store_name'];
      $responses[]=$response;
       }
	 

echo json_encode($responses,true);



?>
