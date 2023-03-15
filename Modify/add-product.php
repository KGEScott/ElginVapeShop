<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Define file destination
    $destination = "../Images/ProductImages/";

    // Check if file is uploaded
    if (isset($_FILES["image-upload"]) && $_FILES["image-upload"]["error"] == 0) {

        // Get file info
        $file_name = $_FILES["image-upload"]["name"];
        $file_size = $_FILES["image-upload"]["size"];
        $file_tmp = $_FILES["image-upload"]["tmp_name"];
        $file_type = $_FILES["image-upload"]["type"];
        $file_ext = strtolower(end(explode(".", $file_name)));

        // Check if file type is image
        if ($file_type != "image/jpeg" && $file_type != "image/png" && $file_type != "image/gif") {
            echo "Only JPG, PNG, and GIF files are allowed.";
            echo '<a href="http://www.elginvapeshop.com/Modify">Back to Modify Page</a>';
            exit;
        }

        // Check if file size is less than 5MB
        if ($file_size > 5 * 1024 * 1024) {
            echo "File size must be less than 5MB.";
            echo '<a href="http://www.elginvapeshop.com/Modify">Back to Modify Page</a>';
            exit;
        }

        // Generate unique file name
        $new_file_name = uniqid() . "." . $file_ext;

        // Move file to destination folder
        if (move_uploaded_file($file_tmp, $destination . $new_file_name)) {

            // File moved successfully, save file info to database
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

            $sql = "INSERT INTO products (name, description, price, image, category) VALUES ('" . $_POST["name"] . "', '" . $_POST["description"] . "', '" . $_POST["price"] . "', '" . $destination . $new_file_name . "', '" . $_POST["Category"] . "')";

            if ($conn->query($sql) === TRUE) {
            header("Location: http://elginvapeshop.com/Modify");
            exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        } else {
            echo "File upload failed.";
            echo '<a href="http://www.elginvapeshop.com/Modify">Back to Modify Page</a>';
            exit;
        }
    }
}
?>