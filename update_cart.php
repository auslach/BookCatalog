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

  if (!isset($_SESSION['cart_items'])) {
    $_SESSION['cart_items'] = array();
  }

  include('config.php');
  // Update cart button

  // Put new item in cart, or update quantity
  $isbn13 = isset($_POST['isbn13']) ? $_POST['isbn13'] : "";
  $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : "";

  if (isset($_POST['isbn13'])) {
    if(array_key_exists($isbn13, $_SESSION['cart_items'])) {
      header("Location: cart.php");
      $current_quantity = $_SESSION['cart_items'][$isbn13];
      $_SESSION['cart_items'][$isbn13]=$current_quantity+1;
    } else {
      $_SESSION['cart_items'][$isbn13]=$quantity;
      header("Location: cart.php");
    }
  } else {
    // set new quantity
    foreach ($_POST as $key => $value) {
      $_SESSION['cart_items'][$key]=$value;
    }
  }
?>

        <h1>CIS Department Book Catalog</h1>

        <?php include('cart_items.php'); ?>

        <h3><a href="index.php">Back to Catalog</a></h3>
  </body>
</html>
