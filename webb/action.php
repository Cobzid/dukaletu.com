<?php 
include("conn.php");
$action = $_POST['submit'];

switch ($action) {
    case "add items":
        $item = $_POST['item'];
        $description = $_POST['description'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $picture = $_FILES['picture'];
        $picture_name = $_FILES['picture']['name'];

        // Establish database connection (assuming $_conn is your database connection variable)
        // Ensure you use the correct variable name for your database connection
        $sql = $conn->query("INSERT INTO stock (item, category, description, price, picture)
                              VALUES ('$item', '$category', '$description', '$price', '$picture_name')");
        
        // Move uploaded picture to desired location
        move_uploaded_file($picture["name"], __DIR__ . "/image/" . $picture_name);
        
        // Close database connection
        $conn = null;
        
        // Notify user and redirect to admin.php
        echo "<script>alert('Item successfully added');</script>";
        echo "<script>window.location = 'admin.php';</script>";
        break;
    case "buy":
        $item = $_POST['item'];
        $item_id = $_POST['item_id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $price = $price *$quantity;
      
        // Establish database connection (assuming $_conn is your database connection variable)
        // Ensure you use the correct variable name for your database connection
        $sql = $conn->query("INSERT INTO sales (item, item_id, price, quantity)
                              VALUES ('$item', '$item_id', '$price', '$quantity')");
                 $conn = null;
                 echo "
                 <script>alert('item successfully added') </script>
                 <script>Window.location = 'index.php'</script>
                 ";

        break;
    default:
        echo "Invalid action";
}

?>;