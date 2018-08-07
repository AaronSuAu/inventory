<?php
require_once "./vendor/autoload.php";
use Service\Implement\OrderProcessorImpl;
use Service\Products;
$orderProcessorImpl = OrderProcessorImpl::getOrderProcessorImpl();
$orderProcessorImpl->processFromJson("./orders-sample.json");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Summary</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<table class="table">
    <tbody>
    <tr>
        <th scope="row">#</th>
        <td>Stock Levels</td>
        <td>Product Sold</td>
        <td>Product Received</td>
        <td>Product Pending</td>
    </tr>
    <?php
    foreach (Products::products as $productId){
        echo "<tr>";
        echo "<th>".htmlspecialchars(Products::productsName[$productId])."</th>";
        echo "<td>".htmlspecialchars(Products::$stockLevels[$productId])."</td>";
        echo "<td>".htmlspecialchars(Products::$stockSold[$productId])."</td>";
        echo "<td>".htmlspecialchars(Products::$receivedStocks[$productId])."</td>";
        echo "<td>".htmlspecialchars(Products::$pendingOrder[$productId])."</td>";
        echo "<tr/>";
    }
    ?>
    </tbody>
</table>
<!-- built files will be auto injected -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>