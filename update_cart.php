<html lang="en-US">
  <head>
    <title>Shopping Cart</title>
  <style>
    table, th, tr, td {
      border: 1px solid black;
    }
    img {
      width: 100px;
      height: 100px;
    }
  </style>
  </head>
  <body>

 <?php
 include('config.php');

 global $cart;
 $isbn13 = $_POST['isbn13'];
 $quantity = $_POST['quantity'];

 if (isset($isbn13) && isset($quantity)) {
   $cart[$isbn13] = $quantity;
 }
 ?>

<?php Print_r($cart) ?>

        <h1>CIS Department Book Catalog</h1>

        <?php include('cart.php'); ?>

        <h3><a href="index.php">Back to Catalog</a></h3>
  </body>
</html>
