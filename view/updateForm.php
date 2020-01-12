<section>
  <a href="index"><button class="btn"><span class="glyphicon glyphicon-arrow-left"></span> Ga terug naar overzicht</button></a>
  <br><br>
  <?php
  $html = "";
  while ($row = $productDetails->fetch(PDO::FETCH_ASSOC)) {
    $html .= "<form action='index.php?op=updateProduct&id=$_REQUEST[id]' method='POST'>";
    $html .= "<input class='form-control' type='number' value='" . $row['product_type_code'] . "' name='product_type_code' placeholder='Type code'><br>";
    $html .= "<input class='form-control' type='number' value='" . $row['supplier_id'] . "'name='supplier_id' placeholder='Supplier ID'><br>";
    $html .= "<input class='form-control' type='text' value='" . $row['product_name'] . "'name='product_name' placeholder='Product naam'><br>";
    $html .= "<input class='form-control' type='text' value='" . $row['product_price'] . "'name='product_price' placeholder='Product prijs'><br>";
    $html .= "<input class='form-control' type='text' value='" . $row['other_product_details'] . "'name='other_product_details' step='0,01' placeholder='Details'><br>";
    $html .= "<input class='btn' type='submit' name='submit'>";
    $html .= "</form>";
  }
  echo $html;
  ?>
</section>