<?php
include 'includes/database.inc.php'; // Include database connection

// Get sorting and search filters
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'lastName';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// SQL query for fetching customers
$query = "SELECT * FROM customers WHERE lastName LIKE :search ORDER BY $sort";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':search', "%$search%");
$stmt->execute();
$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer List</title>
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
            <div class="panel panel-danger">
                <div class="panel-heading"><h4>Customers</h4></div>
                <form method="GET" class="form-inline">
                    <input type="text" name="search" placeholder="Search by last name" value="<?php echo htmlspecialchars($search); ?>" class="form-control">
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th><a href="?sort=lastName">Name</a></th>
                            <th>Email</th>
                            <th>Address</th>
                            <th><a href="?sort=city">City</a></th>
                            <th><a href="?sort=country">Country</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $customer): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($customer['lastName'] . ', ' . $customer['firstName']); ?></td>
                            <td><?php echo htmlspecialchars($customer['email']); ?></td>
                            <td><?php echo htmlspecialchars($customer['address']); ?></td>
                            <td><?php echo htmlspecialchars($customer['city']); ?></td>
                            <td><?php echo htmlspecialchars($customer['country']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="bootstrap3_bookTheme/assets/js/jquery.js"></script>
<script src="bootstrap3_bookTheme/dist/js/bootstrap.min.js"></script>
</body>
</html>
