<section class="col-md-4 thumbnail">
  <h2>Maak hier een product aan </h2>
  <form action="index.php?op=createProduct" method="post">
    <input class="form-control" type="number" name="product_type_code" placeholder="Type code"><br>
    <input class="form-control" type="number" name="supplier_id" placeholder="Supplier ID"><br>
    <input class="form-control" type="text" name="product_name" placeholder="Product naam"><br>
    <input class="form-control" type="text" name="product_price" placeholder="Product prijs"><br>
    <input class="form-control" type="text" name="other_product_details" placeholder="Details"><br>
    <br>
    <input type="submit" class="btn">
  </form>
</section>