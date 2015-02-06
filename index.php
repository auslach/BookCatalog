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

  	$query = 'SELECT course.courseID, course.courseTitle, book.isbn13, book.bookTitle, book.price
							FROM book
							JOIN coursebook
							ON book.isbn13=coursebook.book
							JOIN course
							ON coursebook.course=course.courseID
							ORDER BY course.courseID';

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
			  		<a href="http://www.csupomona.edu/~cba/computer-information-systems/curriculum/courses.shtml" target="_blank"><?php echo $book['courseID']; ?></a>
		  		</td>
		  		<td>
			  		<?php echo $book['courseTitle']; ?>
		  		</td>
		  		<td>
		  			<img src="images/<?php echo $book['isbn13']; ?>.jpg" />
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
