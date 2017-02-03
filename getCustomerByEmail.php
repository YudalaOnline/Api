  <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);


    $objectManager = $bootstrap->getObjectManager();
    $url = \Magento\Framework\App\ObjectManager::getInstance();
    $storeManager = $url->get('\Magento\Store\Model\StoreManagerInterface');
    $state = $objectManager->get('\Magento\Framework\App\State'); 
    $state->setAreaCode('frontend');
    $websiteId = $storeManager->getWebsite()->getWebsiteId();
    // Get Store ID
    $store = $storeManager->getStore();
    $storeId = $store->getStoreId();
    $customerFactory = $objectManager->get('\Magento\Customer\Model\CustomerFactory'); 
    $customer=$customerFactory->create();
    $customer->setWebsiteId($websiteId);

    $email=$_REQUEST['email'];
    $customer->loadByEmail($email);// load customer by email address
   $customer->load($customer->getEntityId());// load customer by email address
    $data= $customer->getData();
    echo json_encode($data);