<div>
  <?= $productsSearch ?>
</div>

<?php
$toDay = date("Y/m/d");
$tomorrow = date("Y-m-d", time() + 86400);
echo($products[1]);

echo "<div class='form-group row'>";
for ($i = 1; $i <= $products[0]; $i ++) {
  echo "
  <div class='col' style='margin-right: 5px;'>
  <a href='index.php?op=read&p=$i'><u>" . " " . $i . "</u></a>
  </div>
  ";
}


// echo "<div class='col float-right'><a><button class='btn'>Export CSV</button></a></div>";
// echo "<div class='col float-right input-group input-daterange'>";
// echo "<input type='text' class='form-control' value='" . date("Y/m/d") . "' placeholder='from'>";
// echo "<div class='input-group-addon'>to</div>";
// echo "<input type='text' class='form-control' value='" . date("Y-m-d", time() + 86400) . "' placeholder='till'>";
// echo "</div>";
// echo "</div>";
?>