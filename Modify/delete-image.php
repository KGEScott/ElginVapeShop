<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if product ID is set
    if (isset($_POST["product"])) {

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

        // Get product image path
        $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
        if (!$stmt) {
            echo "Error preparing SELECT statement: " . $conn->error;
            exit();
        }
        if (!$stmt->bind_param("i", $_POST["product"])) {
            echo "Error binding parameters for SELECT statement: " . $stmt->error;
            exit();
        }
        if (!$stmt->execute()) {
            echo "Error executing SELECT statement: " . $stmt->error;
            exit();
        }
        $stmt->bind_result($image);
        $stmt->fetch();

        // Delete image file from server
        unlink($image);

        // Close statement and connection
        $stmt->close();
        $conn->close();

        // Call delete-product.php file to delete row from database
        require_once('delete-product.php');
        delete_product($_POST["product"]);

        echo "Image deleted successfully.";
    } else {
        echo "Product ID not set.";
    }
}
?>
