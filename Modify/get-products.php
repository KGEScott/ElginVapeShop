<?php

// Check if category is set
if (isset($_GET["category"])) {

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

    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT id, name FROM products WHERE category = ?");
    $stmt->bind_param("i", $_GET["category"]);
    $stmt->execute();
    $stmt->bind_result($product_id, $product_name);

    // Generate HTML for product options
    $html = "";
    while ($stmt->fetch()) {
        $html .= "<option value=\"$product_id\">$product_name</option>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();

    // Return product options
    echo $html;
}
?>

