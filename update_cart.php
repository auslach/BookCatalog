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
 
 $query = "SELECT * FROM book WHERE isbn13 = $isbn13 LIMIT 1";
 $book = $db->query($query);
 $book = $book->fetch();
 ?>


 <?php echo $book['bookTitle']; ?>
      
        <h1>CIS Department Book Catalog</h1>
  <table>
  	<th>
  		Course #
  	</th>
  	<th>
  		Book Title
  	</th>
  	<th>
  		Price
  	</th>
  	<th>
  		Quantity
  	</th>
  	<th>
  		Sub Total
  	</th>
        <?php echo $cart ?>
        <?php //foreach ($cart as $book) { ?>
      <tr>
        <td>
          <?php //echo $book['courseID']; ?>
        </td>
  </table>
        <?php //} ?>
        <h3><a href="index.php">Back to Catalog</a></h3>
  </body>
</html>
