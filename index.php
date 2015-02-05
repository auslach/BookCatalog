<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Book Catalog</title>
  </head>
  <body>
  <?php 
  	$dsn = 'mysql:host=localhost;dbname=BookCatalog';
  	$username = 'php';
  	$password = 'php';

  	$db = new PDO($dsn, $username, $password);

  	$query = 'SELECT * FROM BOOK';

  	$

  	$catalog = $db->query($query);
  ?>

  <table>
  	<th>
  		Course #
  	</th>
  	<th>
  		Course Title
  	</th>
  	<th>
  		Book Image
  	</th>
  	<th>
  		Book Title
  	</th>
  	<th>
  		Price
  	</th>
  	<th>
  		Add to Cart
  	</th>
		  <?php foreach ($catalog as $book) { ?>
		  	<tr>
		  		<td>
		  			Course #
		  		</td>
		  		<td>
		  			Course Title
		  		</td>
		  		<td>
		  			Book Image
		  		</td>
		  		<td>
		  		<?php echo $book['bookTitle']; ?>
		  		</td>
		  		<td>
				  	<?php echo $book['price']; ?>
		  		</td>
		  		<td>
		  			Add to cart
		  		</td>
		  	</tr>
			<?php } ?>
	  </table>

  </body>
</html>
