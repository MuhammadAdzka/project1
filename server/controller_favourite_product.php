<?php
     include('connection.php');
     $query_fav_product = "SELECT * From products Where product_criteria = 'favourite' Limit 8";
     
     $stmt_fav_product = $conn->prepare($query_fav_product);
     
     $stmt_fav_product->execute();
     
     $fav_products = $stmt_fav_product->get_result();

?>