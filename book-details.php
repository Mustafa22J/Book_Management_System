<!DOCTYPE html>
<html lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="">
   <meta name="author" content="">
   <title>Book Template</title>
   <link rel="shortcut icon" href="../../assets/ico/favicon.png">   
   <link href="bootstrap3_bookTheme/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="bootstrap3_bookTheme/theme.css" rel="stylesheet">
</head>

<body>

<?php include 'includes/book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">
      <div class="col-md-2">
         <?php include 'includes/book-left-nav.inc.php'; ?>
      </div>
      <div class="col-md-10">
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>Book Details</h4></div>
           <table class="table">
             <?php
             include 'includes/database.inc.php';

             $bookId = isset($_GET['id']) ? intval($_GET['id']) : 0;

             $sql = "SELECT Books.*, 
                            Subcategories.SubcategoryName, 
                            Imprints.Imprint, 
                            BindingTypes.BindingType, 
                            ProductionStatuses.ProductionStatus,
                            GROUP_CONCAT(CONCAT(Authors.FirstName, ' ', Authors.LastName) SEPARATOR ', ') AS Authors
                     FROM Books
                     LEFT JOIN Subcategories ON Books.SubcategoryID = Subcategories.ID
                     LEFT JOIN Imprints ON Books.ImprintID = Imprints.ID
                     LEFT JOIN BindingTypes ON Books.BindingTypeID = BindingTypes.ID
                     LEFT JOIN ProductionStatuses ON Books.ProductionStatusID = ProductionStatuses.ID
                     LEFT JOIN BookAuthors ON Books.ID = BookAuthors.BookID
                     LEFT JOIN Authors ON BookAuthors.AuthorID = Authors.ID
                     WHERE Books.ID = :bookId
                     GROUP BY Books.ID";

             $stmt = $pdo->prepare($sql);
             $stmt->bindValue(':bookId', $bookId, PDO::PARAM_INT);
             $stmt->execute();

             $book = $stmt->fetch(PDO::FETCH_ASSOC);

             if ($book) {
                 echo "<tr><th>Cover</th><td><img src='images/tinysquare/" . htmlspecialchars($book['ISBN10']) . ".jpg' alt='Book Cover'></td></tr>";
                 echo "<tr><th>Title</th><td>" . htmlspecialchars($book['Title']) . "</td></tr>";
                 echo "<tr><th>Authors</th><td>" . htmlspecialchars(isset($book['Authors']) ? $book['Authors'] : 'N/A') . "</td></tr>";
                 echo "<tr><th>ISBN-10</th><td>" . htmlspecialchars($book['ISBN10']) . "</td></tr>";
                 echo "<tr><th>ISBN-13</th><td>" . htmlspecialchars($book['ISBN13']) . "</td></tr>";
                 echo "<tr><th>Copyright Year</th><td>" . htmlspecialchars($book['CopyrightYear']) . "</td></tr>";
                 echo "<tr><th>Instock Date</th><td>" . htmlspecialchars(isset($book['InstockDate']) ? $book['InstockDate'] : 'N/A') . "</td></tr>";
                 echo "<tr><th>Trim Size</th><td>" . htmlspecialchars($book['TrimSize']) . "</td></tr>";
                 echo "<tr><th>Page Count</th><td>" . htmlspecialchars(isset($book['PageCount']) ? $book['PageCount'] : 'N/A') . "</td></tr>";
                 echo "<tr><th>Description</th><td>" . htmlspecialchars($book['Description']) . "</td></tr>";
                 echo "<tr><th>Sub Category</th><td>" . htmlspecialchars($book['SubcategoryName']) . "</td></tr>";
                 echo "<tr><th>Imprint</th><td>" . htmlspecialchars($book['Imprint']) . "</td></tr>";
                 echo "<tr><th>Binding Type</th><td>" . htmlspecialchars($book['BindingType']) . "</td></tr>";
                 echo "<tr><th>Production Status</th><td>" . htmlspecialchars($book['ProductionStatus']) . "</td></tr>";
             } else {
                 echo "<tr><td colspan='2'>No book found with the specified ID.</td></tr>";
             }
             ?>
           </table>
         </div>           
      </div>
   </div>
</div>
</body>
</html>
