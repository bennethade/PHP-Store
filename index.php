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
 $items = $entityManager->getRepository('App\Entity\Products')->findAll();


//try {
//    $entityManager->flush();
//    header('Location: index.php');
//} catch (OptimisticLockException | ORMException  $e) {
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Product list</title>
</head>
<body>

<form action="managerClass.php" method="post">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Product </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
      
      </ul>
      
        <button onclick = "window.location.href='add-product.php';" class="btn btn-primary" type="button">ADD</button>

        <div style="width: 20px;"></div>

        <button name="mass_delete" class="btn btn-danger" type="submit" id="mass_delete" value="Mass delete">MASS DELETE</button>

    </div>
  </div>
</nav>
<div class="row">



    <?php
    foreach ($items as $item){

    ?>

        <div class="col-sm-3">
            <div class="container flex border m-3 ">
                <input type="checkbox" name="ids[]" value="<?php echo $item->getId() ?>" id="" class="delete-checkbox">
                <h4> <?php echo $item->getSku(); ?> </h4>
                <h4> <?php echo $item->getProductName(); ?> </h4>
                <h3> &#36;<?php echo $item->getPrice(); ?></h3>
                <p><?php echo $item->size == null ? "" : "Size:".$item->getSize()." Mb" ; ?></p>
                <p><?php echo $item->weight == null ? "" : "Weight:".$item->getWeight()." Kg" ; ?></p>
                <p><?php echo $item->height == null ? "" : "Dimensions:".$item->getHeight()."x".$item->getWidth()."x".$item->getLength(); ?></p>
            </div>
        </div>


    <?php
    }
    ?>



<script>
    $(document).ready(function () {
        $('#mass_delete').click(function() {
            var checked = $("input[type=checkbox]:checked").length;

            if(!checked) {
                alert("You must check at least one checkbox.");
                return false;
            }

        });
    });

</script>

</div>
</form>
</body>
</html>