<?php
header('Content-Type: application/json');

// Check if product ID is set and is numeric
if (isset($_GET["product"]) && is_numeric($_GET["product"])) {

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

    // Prepare SQL statement to get product details from database
    $sql = "SELECT name, description, price FROM products WHERE id = ".$_GET["product"].";";

    // Execute query
    $result = $conn->query($sql);

    // Check if there is exactly one row returned
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $description = $row["description"];
        $price = $row["price"];

        // Return JSON response with product details
        echo json_encode(array("name" => $name, "description" => $description, "price" => $price));
    } else {
        // Return empty JSON response if no rows or multiple rows are returned
        echo json_encode(array());
    }

    // Close connection
    $conn->close();

} else {
    // Return error JSON response if product ID is not set or is not numeric
    echo json_encode(array("error" => "Invalid product ID"));
}
?>
