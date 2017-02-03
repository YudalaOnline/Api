<?php

 ini_set("display_errors",1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$obj = $bootstrap->getObjectManager();
$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');

$url = \Magento\Framework\App\ObjectManager::getInstance();


$helper = $obj->get('Yudala\City\Helper\Data');

$email=$_REQUEST['email'];
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$street=$_REQUEST['street'];
$city=$_REQUEST['city'];
$region_id=$_REQUEST['region_id'];
$telephone=$_REQUEST['telephone'];
$smethod=$_REQUEST['smethod'];
$pmethod=$_REQUEST['pmethod'];

$quote_id=$_REQUEST['quote_id'];

$tempOrder=[
     'currency_id'  => 'NGN',
     'email'        => $email, //buyer email id
     'shipping_address' =>[
            'firstname'    => $fname, //address Details
            'lastname'     => $lname,
                    'street' => $street,
                    'city' => $city,
            'country_id' => 'NG',
            'region' => $region_id,
            'postcode' => '234',
            'telephone' => $telephone,
            'fax' => '234',
            'save_in_address_book' => 0
                 ]
 
];
$response= $helper->createMageOrder($tempOrder,$pmethod,$smethod,$quote_id);
echo json_encode($response);
//echo 'Output : '.$email.$fname.$lname.$street.$city.$telephone.$response['order_id'];




