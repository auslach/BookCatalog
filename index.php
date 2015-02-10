<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Book Catalog</title>
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
    include('config.php');

    $limit = 6;
    $adjacents = 3;
    global $cart;

    $page = isset($_GET['page']) ? $_GET['page'] : 1;
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
    $prev_1 = $prev - 1; // prev, subtract 1 from page
    $next_1 = $next + 1; // next, add 1 to page

  ?>
  <h1>CIS Department Book Catalog</h1>
  <h3><a href="cart.php">View Cart</a></h3>
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
          <a href="book.php?id=<?php echo $book['isbn13']; ?>">
            <img src="images/<?php echo $book['isbn13']; ?>.jpg" />
          </a>
        </td>
        <td>
          <a href="book.php?id=<?php echo $book['isbn13']; ?>">
            <?php echo $book['bookTitle']; ?>
          </a>
        </td>
        <td>
          $<?php echo $book['price']; ?>
        </td>
        <td>
          <form action="update_cart.php"
                method="post"
                value="Add to Cart">
              <input type="hidden"
                           name="quantity"
                           value="1" />
              <input type="hidden"
                           name="isbn13"
                           value="<?php echo $book['isbn13']; ?>" />
              <input type="submit"
                           value="Add to Cart" />
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>

  <table>
    <tr>
      <?php if ($page > 1) : ?>
        <?php if ($page > 2) : ?>
          <td>
            <a href="<?php echo "?page=$prev_1"; ?>"><?php echo $prev_1; ?></a>
          </td>
        <?php endif; ?>
        <td>
          <a href="<?php echo "?page=$prev"; ?>"><?php echo $prev; ?></a>
        </td>
      <?php endif; ?>
      <td>
        <?php echo $page; ?>
      </td>
        <?php if ($count > $page) : ?>
          <td>
            <a href="<?php echo "?page=$next"; ?>"><?php echo $next; ?></a>
          </td>
          <?php if ($count > $page + 1) : ?>
            <td>
              <a href="<?php echo "?page=$next_1"; ?>"><?php echo $next_1; ?></a>
            </td>
          <?php endif; ?>
        <?php endif; ?>
    </tr>
  </table>

  </body>
</html>
