<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM expenses WHERE user_id='$user_id' ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Expenses</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #007bff;
            padding: 15px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
        }
        .navbar .brand {
            font-size: 24px;
            font-weight: bold;
        }
        .navbar .links {
            display: flex;
        }
        .navbar .links a {
            margin-left: 20px;
        }
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table thead {
            background-color: #007bff;
            color: white;
        }
        .table th, .table td {
            padding: 15px;
            text-align: left;
        }
        .table th {
            font-weight: bold;
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Expense Manager</div>
        <div class="links">
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                View Your Expenses
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>Amount</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['date']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                                <td>$<?php echo number_format($row['amount'], 2); ?></td>
                                <td><?php echo htmlspecialchars($row['category']); ?></td>
                            </tr>
                        <?php } ?>
                        <?php if ($result->num_rows == 0) { ?>
                            <tr>
                                <td colspan="4" class="text-center">No expenses recorded.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
