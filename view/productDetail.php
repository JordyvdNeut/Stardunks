<?php

?>

<section>
  <?php 
  $html = "";

  while($row = $productDetails) {
    $html .= "<div class='thumbnail'>";
    $html .= "<h1>Naam: " . $row['product_name'] .  "</h1>";
    $html .= "<p>Prijs: €" . $row['product_price'] .  "</p>";
    $html .= "</div>";
  }
  echo $html;
  ?>
</section>