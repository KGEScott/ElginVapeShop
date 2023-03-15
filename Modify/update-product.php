<?php
if (isset($_POST['update'])) {
    // Connect to database
    $servername = "servername";
    $username = "username";
    $password = "password";
    $dbname = "dbname";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to update product details
    $stmt = $conn->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $_POST['name'], $_POST['description'], $_POST['price'], $_POST['product']);
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to home page
    header("Location: /Modify/index.html");
    exit();
}
?>
