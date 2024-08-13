<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];
    $date = $_POST['date'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO expenses (user_id, title, amount, category, date) VALUES ('$user_id', '$title', '$amount', '$category', '$date')";

    if ($conn->query($sql) === TRUE) {
        $success = "Expense added successfully!";
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Expense</title>
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
            max-width: 800px;
            margin: auto;
        }
        .card {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .card-header {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
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
        .alert {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 15px;
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
                Add New Expense
            </div>
            <div class="card-body">
                <?php if (isset($success)) { ?>
                    <div class="alert">
                        <?php echo $success; ?>
                    </div>
                <?php } ?>
                <?php if (isset($error)) { ?>
                    <div class="alert" style="background: #f8d7da; color: #721c24;">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
                <form action="add_expense.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
                            <option value="">Select category</option>
                            <option value="Food">Food</option>
                            <option value="Transport">Transport</option>
                            <option value="Utilities">Utilities</option>
                            <option value="Entertainment">Entertainment</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <button type="submit" class="btn-primary">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
