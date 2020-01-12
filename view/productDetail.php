<section>
  <?php
  $html = "";

  foreach ($productDetails as $row)
    $row['product_price'] = '€ ' . str_replace('.', ',', $row['product_price']);
  $html .= "<div class='thumbnail'>";
  $html .= "<h2>$row[product_name]</h2>";
  $html .= "<p>Prijs: $row[product_price]</p>";
  $html .= "<br />";
  $html .= "<p>Product details: $row[other_product_details]</p>";
  // foreach ($row as $value) {
  //   $html .= "<p>$value</p>";
  // }
  $html .= "</div>";

  echo $html;
  ?>
</section>