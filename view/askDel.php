<h1>Verwijderen</h1>
<div>
  <?php
  $html = "";
  if ($product) {
    $html .= "<div>";
    $html .= "<p>Weet u zeker dat u <strong> $product[product_name] </strong> wilt gaan verwijderen</p>";
    $html .= "<br />";
    $html .= "<a href='index.php?op=deleteProduct&id=$product[product_id]'><button class='btn'>Ja ik wil dit product verwijderen</button></a>";
    $html .= "<a href='index.php?op=products'><button class='btn'>Anuleren</button></a>";
    $html .= "</div>";
  }
  echo $html;
  ?>
</div>