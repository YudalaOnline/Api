 <?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');


$_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
$fname=$_REQUEST['fname'];
$lname=$_REQUEST['lname'];
$country_id='NG';
$id=$_REQUEST['id'];
$region_id=$_REQUEST['region_id'];
$city=$_REQUEST['city'];
$tel=$_REQUEST['tel'];
$street=$_REQUEST['street'];
$billing=$_REQUEST['billing'];
$shipping=$_REQUEST['shipping'];

$response=array();
$addresss = $_objectManager->get('\Magento\Customer\Model\AddressFactory');
                    $address = $addresss->create();
                    $address->setCustomerId($id)
                    ->setFirstname($fname)
                    ->setLastname($lname)
                    ->setCountryId($country_id)
                   ->setRegionId($region_id) //state/province, only needed if the country is USA
                    ->setPostcode('234')
                    ->setCity($city)
                    ->setTelephone($tel)
                    ->setStreet($street)           
                    ->setSaveInAddressBook('1');
              if($billing)
                $address->setIsDefaultBilling(true);

                  if($shipping)
                $address->setIsDefaultShipping(true);

                    try{
                        $address->save();
                       $response['id']=$address->getId();
                    
                      $response['status']='200';
                      $response['message']='Adddress has been added!';
                          
                    }
                    catch (Exception $e) {
                            Zend_Debug::dump($e->getMessage());
                            $response['status']='-1';
                        $response['message']='Adddress could not be added!';
                    }
  
 echo json_encode($response);

?>
