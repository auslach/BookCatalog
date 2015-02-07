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
    include('config.php');

    $id = $_GET['id'];

    $book_query = "SELECT book.bookTitle, book.price, publisher.publisher, book.description, book.edition, book.publishDate, book.length, book.isbn13
                  FROM book
                  JOIN coursebook
                  ON book.isbn13=coursebook.book
                  JOIN course
                  ON coursebook.course=course.courseID
                  JOIN publisher
                  ON book.publisher=publisher.publisherID
                  WHERE book.isbn13=$id LIMIT 1";

    $author_query = "SELECT author.firstName, author.lastName
                  FROM book
                  JOIN authorbook
                  ON book.isbn13=authorbook.book
                  JOIN author
                  ON authorbook.author=author.authorID
                  WHERE book.isbn13=$id";

    $course_query = "SELECT course.courseID, course.courseTitle, course.credit
                    FROM book
                    JOIN coursebook
                    ON book.isbn13=coursebook.book
                    JOIN course
                    ON coursebook.course=course.courseID
                    WHERE book.isbn13=$id";

    $book = $db->query($book_query);
    $author = $db->query($author_query);
    $course = $db->query($course_query);
    foreach ($book as $b) {}
  ?>

  <table>
    <tr>
      <td>
          <img src="/images/<?php echo $b['isbn13']; ?>.jpg" />
      </td>
      <td>
        <dl>
          <dt>
            For Course(s):
          </dt>
          <?php foreach ($course as $c) { ?>
            <dd>
              <?php echo $c['courseID']; ?>
              <?php echo $c['courseTitle']; ?>
              (<?php echo $c['credit']; ?>)
            </dd>
          <?php } ?>
          <dt>
            Book Title:
          </dt>
          <dd>
            <?php echo $b['bookTitle']; ?>
          </dd>
          <dt>
            Price:
          </dt>
          <dd>
            <?php echo $b['price']; ?>
          </dd>
          <dt>
            Authors:
          </dt>
            <?php foreach ($author as $a) { ?>
              <dd>
                <?php echo $a['firstName']; ?>
                <?php echo $a['lastName']; ?>
              </dd>
            <?php } ?>
          <dt>
            Publisher:
          </dt>
          <dd>
            <?php echo $b['publisher']; ?>
          </dd>
          <dt>
            Edition:
          </dt>
          <dd>
          <?php echo $b['edition']; ?> edition (<?php echo $b['publishDate']; ?>)
          </dd>
          <dt>
            Length:
          </dt>
          <dd>
            <?php echo $b['length']; ?>
          </dd>
          <dt>
            ISBN-13::
          </dt>
          <dd>
            <?php echo $b['isbn13']; ?>
          </dd>
        </dl>
      </td>
      <td>
        <a href="#">Add to Cart</a>
        <br />
        <a href="#">View Cart</a>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        Production Description: <br />
        <?php echo $b['description']; ?>
      </td>
    </tr>
  </table>

  </body>
</html>
