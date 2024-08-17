<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <title>Add products</title>
</head>
<body>

<?php
 if(array_key_exists("error",$_GET) ){
     ?>
<script>
    alert("sku id already exist!");
</script>
    <?php
 }
?>

<form action="managerClass.php" method="post" id="product_form">
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Product </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mynavbar">
      <ul class="navbar-nav me-auto">
      
      </ul>
      
        <Button name="submit" class="btn btn-primary" type="submit" >Save</Button>

      <div style="width: 20px;"></div>
      
      <button onclick = "window.location.href='index.php';" class="btn btn-danger" type="button">Cancel</button>
    
    </div>
  </div>
</nav>



    <div class="container ">
        <div class="mb-3 mt-3">
            <label for="sku">SKU:</label>
            <input type="text" class="form-control" id="sku" placeholder="Enter Sku" name="sku" required>
        </div>
        <div class="mb-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="product_name" required>
        </div>
        <div class="mb-3">
            <label for="sku">Price <b>(&#36;)</b>:</label>
            <input type="number" class="form-control" id="price" placeholder="Enter Product Price" name="price" required>
        </div>


        <div class="mb-3">
        <label for="productType">Type Switcher:</label>
            <select class="form-select mt-3" id="productType" name="product_type" required>
                <option value=""></option>
                <option value="book" id="book">Book</option>
                <option value="dvd" id="dvd">DVD</option>
                <option value="furniture" id="furniture">Furniture</option>
            </select>
        </div>



        <div class="container w-50 d-display" >
        </div>

    </div>



</form>

<script>
    $(document).ready(function (){
        var data1 = $('<div class="mb-3 dvd" style="display: block"> </div>');
        data1.html('<label for="size"></label>').text('Please, provide size (mb)');
        data1.append('<input type="number" class="form-control" id="size" placeholder="Enter size" name="size" required>');


        var data2 = $('<div class="mb-3 book" style="display: block"></div>');
          data2.html('<label for="weight"></label>').text('Please, provide weight');
          data2.append('<input type="number" class="form-control" id="weight" placeholder="Enter weight" name="weight" required>');


        var txt = $('<p></p>').text('Please, provide dimensions HxWxL');
        var data3 = $('<div class="mb-3 furniture" style="display: block" ></div>')
            data3.html(' <label for="height"></label>').text('height:');
            data3.append('<input type="number" class="form-control" id="height" placeholder="Enter Height" name="height" required>');

        var data4 = $('<div class="mb-3 furniture" style="display: block" ></div>')
        data4.html(' <label for="width"></label>').text('width:');
        data4.append('<input type="number" class="form-control" id="width" placeholder="Enter Width" name="width" required>');

        var data5 = $('<div class="mb-3 furniture" style="display: block" ></div>')
        data5.html(' <label for="length"></label>').text('length:');
        data5.append('<input type="number" class="form-control" id="length" placeholder="Enter Length" name="length" required>');




        $('#productType').on('change', function() {
            this.value ==="book"?
                $(".d-display").html(data2)
        : this.value ==="furniture" ? $(".d-display").html(txt).append(data3,data4,data5) :
            $(".d-display").html(data1);
        });
    });
</script>

</body>
</html>