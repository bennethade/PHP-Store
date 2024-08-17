<?php
require __DIR__.'/vendor/autoload.php';


use App\Entity\Products;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMSetup;

use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

include "cartModel.php";



$paths = ['cartModel'];
$isDevMode = false;

$connectionParams = [
    'dbname' => 'interview',
    'user' => 'root',
    'password' => '',
    'host' => 'localhost',
    'driver' => 'mysqli',
];
$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$conn = DriverManager::getConnection($connectionParams,$config);

try {
    $entityManager = new EntityManager($conn, $config);
} catch (MissingMappingDriverImplementation $e) {
    echo $e->getMessage();
}




$tool = new SchemaTool($entityManager);
$classes = array(
    $entityManager->getClassMetadata('App\Entity\Products')
);
try {
    $tool->createSchema($classes);
} catch (ToolsException $e) {
}

if(isset($_POST['submit'])){
    $myProducts = new Products();

    $myProducts->setSku($_POST['sku']);
    $myProducts->setProductName($_POST['product_name']);
    $myProducts->setPrice($_POST['price']);
    array_key_exists("size",$_POST)? $myProducts->setSize($_POST['size']) : null;
    array_key_exists("height",$_POST)? $myProducts->setHeight($_POST['height']) : null;
    array_key_exists("weight",$_POST)? $myProducts->setWeight($_POST['weight']) : null;
    array_key_exists("length",$_POST)? $myProducts->setLength($_POST['length']) : null;
    array_key_exists("width",$_POST)? $myProducts->setWidth($_POST['width']) : null;
    $entityManager->persist($myProducts);

    try {
        $entityManager->flush();
        header('Location: index.php');
    } catch (Exception $e) {
        $sku_id = "Sku id already exists";
        header('Location: add-product.php?error='.$sku_id);
    }
}
if(isset($_POST['mass_delete'])){


    $ids = $_POST['ids'];
    foreach ($ids as $id){
          $items = $entityManager->getRepository('App\Entity\Products')->find($id);
          $entityManager->remove($items);
    }

    try {
        $entityManager->flush();
        header('Location: index.php');
    } catch (OptimisticLockException | ORMException  $e) {
    }
}



?>