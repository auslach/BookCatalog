<html lang="en-US">
  <head>
    <title>Shopping Cart</title>
  <style>
    table, th, tr, td {
      border: 1px solid black;
      border-collapse: collapse;
    }
    img {
      width: 100px;
      height: 100px;
    }
  </style>
  </head>
  <body>

<?php
  session_start();
  include('config.php');
?>
        <h1>CIS Department Book Catalog</h1>

        <?php include('cart_items.php'); ?>

        <h3><a href="index.php">Back to Catalog</a></h3>
  </body>
</html>
