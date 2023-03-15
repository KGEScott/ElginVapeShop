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

        // Prepare SQL statement to delete product from database
        $sql = "DELETE FROM products WHERE id = ".$_POST["product"].";";

        // Execute query
        if ($conn->query($sql) === TRUE) {
            header("Location: http://elginvapeshop.com/Modify");
            exit();
        } else {
            echo "Error deleting row: " . $conn->error;
        }

        // Close connection
        $conn->close();

    } else {
        echo "Product ID not set.";
    }
}
?>
