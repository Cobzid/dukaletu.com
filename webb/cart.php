<?php include("conn.php"); ?>
<?php include("header.php"); ?>

<div class="container-fluid">
  <table class="table">
    <thead>
      <tr>
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Total</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT cart.id, stock.item, cart.quantity, stock.price 
              FROM cart 
              JOIN stock ON cart.product_id = stock.id";
      $result = $conn->query($sql);
      $total = 0;

      while ($row = $result->fetch()) {
        $total += $row['quantity'] * $row['price'];
        echo '<tr>';
        echo '<td>' . $row['item'] . '</td>';
        echo '<td>' . $row['quantity'] . '</td>';
        echo '<td>KSh ' . $row['price'] . '</td>';
        echo '<td>KSh ' . ($row['quantity'] * $row['price']) . '</td>';
        echo '<td>';
          // Add remove button with confirmation
          echo '<form action="remove_from_cart.php" method="post">';
          echo '<input type="hidden" name="cart_id" value="' . $row['id'] . '">';
          echo '<button type="submit" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to remove this item?\')">Remove</button>';
          echo '</form>';
        echo '</td>';
        echo '</tr>';
      }
      ?>
    </tbody>
  </table>
  <h3>Total: KSh <?php echo $total; ?></h3>
  <form action="checkout.php" method="post">
    <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
    <label for="phone_number">Phone Number:</label>
    <input type="text" id="phone_number" name="phone_number" required>
    <button type="submit" class="btn btn-primary">Checkout</button>
  </form>
</div>

