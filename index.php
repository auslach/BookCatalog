<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Book Catalog</title>
  <style>
    table, td, tr, td {
      border: 1px solid black;
    }
  </style>
  </head>
  <body>
  <?php
  	$dsn = 'mysql:host=localhost;dbname=BookCatalog';
  	$username = 'php';
  	$password = 'php';

  	$db = new PDO($dsn, $username, $password);
    // ============================

    $limit = 6;
    $adjacents = 3;

    $page = $_GET['page'];
    if ($page) {
      $start = ($page - 1) * $limit;
    } else {
      $start = 0;
    }

  	$select = "SELECT course.courseID, course.courseTitle, book.isbn13, book.bookTitle, book.price
							FROM book
							JOIN coursebook
							ON book.isbn13=coursebook.book
							JOIN course
							ON coursebook.course=course.courseID
							ORDER BY course.courseID";
    $query = $select." LIMIT $start, $limit";

  	$catalog = $db->query($query);
    $count = ceil($db->query($select)->rowCount() / $limit);

    if ($page == 0) $page = 1; // if no page variable, default to 1
    $prev = $page - 1; // prev, subtract 1 from page
    $next = $page + 1; // next, add 1 to page
    $lastpage = ceil($total_pages/$limit);

  ?>
  <br />
  pagination
  <br />

  <table>
    <tr>
      <td>
        <?php if ($page > 1) : ?>
          <a href="<?php echo "?page=$prev"; ?>"><?php echo $prev; ?></a>
        <?php endif; ?>
      </td>
      <td>
        <?php echo $page; ?>
      </td>
      <td>
        <?php if ($count > $page) : ?>
          <a href="<?php echo "?page=$next"; ?>"><?php echo $next; ?></a>
        <?php endif; ?>
      </td>
    </tr>
  </table>
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
				  	$<?php echo $book['price']; ?>
		  		</td>
		  		<td>
		  			Add to cart
		  		</td>
		  	</tr>
			<?php } ?>
	  </table>

  </body>
</html>
