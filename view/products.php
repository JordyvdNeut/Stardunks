<div>
  <?= $productsSearch ?>
  <a href="index.php"><button class="btn">Delete selected</button></a>
  <a href="index.php?op=getProductForm"><button class="btn">create product</button></a>
</div>

<?php
echo $products[1];
for ($i = 1; $i <= $products[0]; $i++) {
  echo "<li><div onClick=/localhost/index.php?op=read&p=" . $i . ">" . $i .
    "</div></li>";
}
?>