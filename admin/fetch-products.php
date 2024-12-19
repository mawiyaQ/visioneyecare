<?php
include('db.php');  // Include database connection

$sql = "SELECT * FROM watches";  // Query to fetch all products
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["stock"] . "</td>";
        echo "<td><img src='" . $row["image"] . "' alt='Product Image' style='width: 50px; height: auto;'></td>";
        echo "<td>
                <a href='edit-product.php?id=" . $row["id"] . "' class='btn btn-warning'>Edit</a>
                <a href='delete-product.php?id=" . $row["id"] . "' class='btn btn-danger'>Delete</a>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No products found</td></tr>";
}

$conn->close();
?>
