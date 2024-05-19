<?php
include("conn.php");

if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the product is already in the cart
    $sql = "SELECT * FROM cart WHERE product_id = '$product_id'";
    $result = $conn->query($sql);

    if ($result !== false && $result->rowCount() > 0) {
        // Update the quantity if the product is already in the cart
        $sql = "UPDATE cart SET quantity = quantity + $quantity WHERE product_id = '$product_id'";
    } 
    else {
        // Insert the new product into the cart
        $sql = "INSERT INTO cart (product_id, quantity) VALUES ('$product_id', '$quantity')";
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit;
    
    }
} else {
    echo "Product ID and quantity are required.";
}
?>