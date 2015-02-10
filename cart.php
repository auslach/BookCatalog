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
      <?php foreach ($cart as $key => $value) { ?>
      <?php
       $query = "SELECT course.courseID, book.bookTitle, book.price
                FROM book
                JOIN coursebook
                ON book.isbn13=coursebook.book
                JOIN course
                ON coursebook.course=course.courseID
                WHERE isbn13 = $key LIMIT 1";
       $key = $db->query($query);
       $book = $key->fetch();
      ?>
    <tr>
      <td>
        <?php echo $book['courseID']; ?>
      </td>
      <td>
          <?php echo $book['bookTitle']; ?>
      </td>
      <td>
          <?php echo $book['price']; ?>
      </td>
      <td>
          <?php echo $value ?>
      </td>
      <td>
          <?php echo $value * $book['price']; ?>
      </td>
</table>
      <?php } ?>
