<?php
include('db.php'); // Include database connection

// Check if form data and file are received
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Handle the image upload
    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $imageTmpName = $image['tmp_name'];
    $uploadDir = 'uploads/';
    $imagePath = $uploadDir . $imageName;

    // Check if uploads directory exists, if not create it
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Move the uploaded file to the uploads directory
    if (move_uploaded_file($imageTmpName, $imagePath)) {
        // Save product data to the database
        $sql = "INSERT INTO watches (name, description, price, stock, image) 
                VALUES ('$name', '$description', '$price', '$stock', '$imagePath')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully!";
            header("Location: manage-products.html");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Failed to upload image.";
    }
}

$conn->close();
?>
