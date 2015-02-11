<?php
  if (isset($_SESSION['cart_items'])) {
    echo count($_SESSION['cart_items']);
    echo Print_r($_SESSION['cart_items']);
  }
?>
<hr />

<?php
  if (isset($_SESSION['cart_items']) && count($_SESSION['cart_items']) > 0) {
    $isbns = "";
    foreach($_SESSION['cart_items'] as $isbn=>$value) {
      $isbns = $isbns . $isbn . ",";
    }
    $isbns = rtrim($isbns, ',');
?>

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
      <?php
        $query = "SELECT book.bookTitle, book.price, book.isbn13
                  FROM book
                  WHERE isbn13 IN ({$isbns})";
       $books = $db->query($query);
       $total = 0;
      ?>
      <?php foreach ($books as $book) { ?>
      <?php
        $quantity = $_SESSION['cart_items'][$book['isbn13']];
        $price = $book['price'] * $_SESSION['cart_items'][$book['isbn13']];
        $total = $total + $price;
      ?>
        <?php
          $isbn = $book['isbn13'];
          $query = "SELECT course.courseID
                    FROM book
                    JOIN coursebook
                    ON book.isbn13=coursebook.book
                    JOIN course
                    ON coursebook.course=course.courseID
                    WHERE isbn13=$isbn";
          $courses = $db->query($query);
        ?>
    <tr>
      <td>
        <?php foreach ($courses as $course) { ?>
          <?php echo $course['courseID']; ?>
          <br />
        <?php } ?>
      </td>
      <td>
          <?php echo $book['bookTitle']; ?>
      </td>
      <td>
          <?php echo "$".$book['price']; ?>
      </td>
      <td>
          <!-- show quantity -->
          <form action="update_cart.php" method="post">
            <input type="number" name="<?php echo $book['isbn13']?>" value="<?php echo $quantity ?>" />
      </td>
      <td>
          <?php echo "$".$price; ?>
      </td>
    </tr>
      <?php } ?>
    <tr>
      <td colspan=4></td>
      <td><?php echo "Total Price: $".$total; ?></td>
    </tr>
</table>

       <input type="submit" value="Update" />
  </form>
<?php
  } else {
    echo "You have no items in your cart";
  }
?>
