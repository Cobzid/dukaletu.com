<?php include 'header.php' ?>

<div class ="container_fluid">

<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="/image/img3.jpg" alt="Los Angeles" style="width:100%;">
        <div class="carousel-caption" style=" color:darkgreen; position:center;"  >
        <h3>welcome to your drip arena </h3>
        <p>just order everything for you</p>
      </div>
      </div>

      <div class="item">
        <img src="/image/img2.jpg" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
        <h3>welcome to your drip arena </h3>
        <p>just order ,we deliver</p>
      </div>
      </div>
    
      <div class="item">
        <img src="/image/img1.jpg" alt="New york" style="width:100%;">
        <div class="carousel-caption">
        <h3>welcome to your drip arena </h3>
        <p>just order everything for you</p>
      </div>
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


 <br>
 <?php
        $sql = "SELECT * FROM stock";
        $result = $conn->query($sql);

        while($row = $result->fetch()) {
            echo '<div class="col-md-4">';
            echo '<div class="card" style="border-radius: 6px; width: 300px;">';
            echo '<img class="card-img-top" src="/image/' . $row['picture'] . '" alt="Card image">';
            echo '<div class="card-body">';
            echo '<h4 class="card-title">' . $row['item'] . '</h4>';
            echo '<p class="card-text">' . $row['description'] . '</p>';
            echo '<p class="card-text">Price: KSh ' . $row['price'] . '</p>';
            echo '<form action="add_to_cart.php" method="post">';
            echo '<input type="number" name="quantity" value="1" min="1" max="10">';
            echo '<input type="hidden" name="product_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="btn btn-primary">Add to Cart</button>';
            echo '</form>';
                        echo '</div>';
            echo '</div>';
            echo '</div>';
            
        }
        ?>;
        <script>
        document.querySelector('input[type="submit " value=""add to cart]').addEventListener('click', function() {
            window.location.href = 'cart.php';
        });
    </script>

   </div>
</div>
  
  
  

<?php include("footer.php"); ?>