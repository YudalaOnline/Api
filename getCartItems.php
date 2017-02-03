<?php

 //ini_set("display_errors",2);
use Magento\Framework\App\Bootstrap;
require __DIR__ . '/../app/bootstrap.php';


$bootstrap = Bootstrap::create(BP, $_SERVER);
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$url = \Magento\Framework\App\ObjectManager::getInstance();

$helper = $obj->get('Yudala\City\Helper\Getcart');

$quote_id=$_REQUEST['quote_id'];

$response= $helper->createMageOrder($quote_id);
header('Content-Type: application/json');
echo $response;