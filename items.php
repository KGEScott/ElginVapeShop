<?php
// Connect to the database
$servername = "servername";
$username = "username";
$password = "password";
$dbname = "dbname";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the category from the URL parameters
$category = $_GET['category'];

// Check if category is equal to 10
if ($category == 10) {
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
} else {
    // Retrieve the items from the database
    $sql = "SELECT * FROM products WHERE category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category);
    $stmt->execute();
    $result = $stmt->get_result();
}

// Build the HTML for the items
$inventory_html = "";
while($row = $result->fetch_assoc()) {
    $inventory_html .= "<div class='item'>
            <img src='" . $row["image"] . "' alt='" . $row["name"] . "'>
            <h3>" . $row["name"] . "</h3>
            <p>" . $row["description"] . "</p>
            <p>Price: $" . $row["price"] . "</p>
        </div>";
}

// Return the HTML for the items
echo $inventory_html;

?>
