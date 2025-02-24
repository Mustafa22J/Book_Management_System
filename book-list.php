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

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_bookTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_bookTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>
<?php include 'includes/book-header.inc.php'; ?>
   
<div class="container">
   <div class="row">  <!-- start main content row -->
      <div class="col-md-2">  <!-- start left navigation rail column -->
         <?php include 'includes/book-left-nav.inc.php'; ?>
      </div>  <!-- end left navigation rail -->

      <div class="col-md-6">  <!-- start main content column -->
         <!-- book panel -->
         <div class="panel panel-danger spaceabove">           
           <div class="panel-heading"><h4>Book Catalog</h4></div>
           <table class="table">
             <tr>
               <th>Cover</th>
               <th>ISBN</th>
               <th>Title</th>
             </tr>
             <?php
             // Include database connection
             include 'includes/database.inc.php';

             // Fetch books from the database
             $sql = "SELECT ID, ISBN13, Title, CoverImage FROM Books ORDER BY Title LIMIT 20";
             $stmt = $pdo->query($sql);

             // Loop through results and display them
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                 // Use CoverImage if available, fallback to placeholder.png
                 $coverImage = !empty($row['CoverImage']) ? htmlspecialchars($row['CoverImage']) : 'placeholder.png';
                 echo "<tr>";
                 echo "<td><img src='images/" . $coverImage . "' alt='Cover' width='50'></td>";
                 echo "<td>" . htmlspecialchars($row['ISBN13']) . "</td>";
                 echo "<td><a href='book-details.php?id=" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['Title']) . "</a></td>";
                 echo "</tr>";
             }
             ?>
           </table>
         </div>           
      </div>
      
      <div class="col-md-2">  <!-- start right navigation rail column -->
         <div class="panel panel-info spaceabove">
            <div class="panel-heading"><h4>Categories</h4></div>
               <ul class="nav nav-pills nav-stacked">
                  <?php
                  // Fetch categories dynamically
                  $sql = "SELECT ID, CategoryName FROM Categories";
                  $stmt = $pdo->query($sql);
                  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                      echo "<li><a href='book-list.php?category=" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['CategoryName']) . "</a></li>";
                  }
                  ?>
               </ul>
         </div>
         
         <div class="panel panel-info">
            <div class="panel-heading"><h4>Imprints</h4></div>
            <ul class="nav nav-pills nav-stacked">
               <?php
               // Fetch imprints dynamically
               $sql = "SELECT ID, Imprint FROM Imprints";
               $stmt = $pdo->query($sql);
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   echo "<li><a href='book-list.php?imprint=" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['Imprint']) . "</a></li>";
               }
               ?>
            </ul>
         </div>

         <div class="panel panel-info">
            <div class="panel-heading"><h4>Status</h4></div>
            <ul class="nav nav-pills nav-stacked">
               <?php
               // Fetch statuses dynamically
               $sql = "SELECT ID, ProductionStatus FROM ProductionStatuses";
               $stmt = $pdo->query($sql);
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   echo "<li><a href='book-list.php?status=" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['ProductionStatus']) . "</a></li>";
               }
               ?>
            </ul>
         </div>

         <div class="panel panel-info">
            <div class="panel-heading"><h4>Binding</h4></div>
            <ul class="nav nav-pills nav-stacked">
               <?php
               // Fetch binding types dynamically
               $sql = "SELECT ID, BindingType FROM BindingTypes";
               $stmt = $pdo->query($sql);
               while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                   echo "<li><a href='book-list.php?binding=" . htmlspecialchars($row['ID']) . "'>" . htmlspecialchars($row['BindingType']) . "</a></li>";
               }
               ?>
            </ul>
         </div>
      </div>  <!-- end right navigation rail -->
   </div>  <!-- end main content row -->
</div>   <!-- end container -->

<script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
<script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
</body>
</html>
