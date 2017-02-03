<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
use Magento\Framework\App\Bootstrap;

require __DIR__ . '/../app/bootstrap.php';

$bootstrap = Bootstrap::create(BP, $_SERVER);
$id=$_REQUEST['id'];

$obj = $bootstrap->getObjectManager();

$state = $obj->get('Magento\Framework\App\State');
$state->setAreaCode('frontend');



$layer=$obj->create('Magento\Catalog\Model\Layer');



$category_id = $layer->getCurrentCategory();
$currentCategoryId= $category_id->getId();
$category = $obj->create('Magento\Catalog\Model\Category')->load($id);
$layer->setCurrentCategory($category);
$attributes = $layer->getFilterableAttributes();
foreach ($attributes as $attribute)
{
    echo $attribute->getAttributeCode().'<br />';

    
}

?>