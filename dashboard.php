<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
            margin-bottom: 20px;
            padding: 20px;
        }
        .card-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
        }
        .card-content {
            font-size: 16px;
            color: #555;
        }
        .card-content ul {
            list-style: none;
            padding: 0;
        }
        .card-content ul li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }
        .card-content ul li:last-child {
            border-bottom: none;
        }
        .btn-primary {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .text-center {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">Expense Manager</div>
        <div class="links">
            <a href="dashboard.php">Home</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Welcome, <?php echo htmlspecialchars($user['name']); ?>!
            </div>
            <div class="card-content">
                <p>Here is your dashboard where you can manage your expenses and view reports.</p>
                <div class="text-center">
                    <a href="add_expense.php" class="btn-primary">Add New Expense</a>
                    <a href="view_expenses.php" class="btn-primary">View Expenses</a>
                </div>
            </div>
        </div>
        <!-- Additional cards or sections can be added here -->
    </div>
</body>
</html>
