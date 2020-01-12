<?php
require_once 'model/DataHandler.php';

class ProductsLogic
{

  public function __construct()
  {
    $this->DataHandler = new DataHandler("localhost", "mysql", "stardunks", "root", "");
    $this->HtmlController = new HtmlController;
  }
  public function __destruct()
  { }

  public function euroSign($result)
  {
    $rows = array();
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
      $row['product_price'] = '€ ' . str_replace('.', ',', $row['product_price']);
      array_push($rows, $row);
    }
    return $rows;
  }

  public function readProducts($position)
  {
    try {
      $items_per_page = 4;
      $position += -1;
      $position = $position * 4;
      $sql = 'SELECT * FROM products LIMIT ' . $position . ', ' . $items_per_page;
      $result = $this->DataHandler->readsData($sql);
      $results = $this->HtmlController->createTable($result);
      $pages = $this->DataHandler->countPages('SELECT COUNT(*) FROM products', $items_per_page);
      return array($pages, $results);
    } catch (exception $e) {
      throw $e;
    }
  }

  public function searchProduct($search_value)
  {
    $items_per_page = 4;
    $sql = "SELECT * FROM products 
    WHERE product_name LIKE '%$search_value%' 
    OR other_product_details LIKE '%$search_value%'";
    $result = $this->DataHandler->readsData($sql);
    $results = $this->HtmlController->createTable($result);
    $pages = $this->DataHandler->countPages('SELECT COUNT(*) FROM products', $items_per_page);
    return array($pages, $results);
  }

  public function readProduct($id)
  {
    try {
      $sql = "SELECT * FROM products WHERE product_id = " . $id;
      $result = $this->DataHandler->readsData($sql);
      return $result;
      // $result = $this->euroSign($res);
    } catch (exception $e) {
      throw $e;
    }
  }

  public function createProduct($formData)
  {
    $product_id = $formData["product_id"];
    $product_type_code = $formData["product_type_code"];
    $supplier_id = $formData["supplier_id"];
    $product_name = $formData["product_name"];
    $product_price = $formData["product_price"];
    $other_product_details = $formData["other_product_details"];

    try {
      $sql = "INSERT INTO products (product_id, product_type_code, supplier_id, product_name, product_price, other_product_details)
        VALUES ('$product_id' ,'$product_type_code' ,'$supplier_id' ,'$product_name' ,'$product_price' ,'$other_product_details')";
      $result = $this->DataHandler->createData($sql);
      return $result = 1 ? "Product succesvol aangemaakt" : "Er is wat fout gegaan bij het aanmaken van het product";
    } catch (exception $e) {
      throw $e;
    }
  }

  public function updateProduct($formData)
  {
    $id = $formData['id'];
    $naam = $formData["product_name"];
    $prijs = $formData["product_price"];
    $typeCode = $formData["product_type_code"];
    $sub_id = $formData["supplier_id"];
    $details = $formData["other_product_details"];
    try {
      $sql = "UPDATE products SET 
        product_type_code = '$typeCode', supplier_id = '$sub_id', 
        product_name = '$naam', product_price = '$prijs', 
        other_product_details = '$details' WHERE product_id = " . $id;
      $result = $this->DataHandler->updateData($sql);
      return $result ? "Product is succesvol bewerkt!" : "Bewerken van het product is niet gelukt";
    } catch (exception $e) {
      throw $e;
    }
  }

  public function deleteProduct($id)
  {
    try {
      $sql = "DELETE FROM products WHERE product_id = " . $id;
      $result = $this->DataHandler->deleteData($sql);
      return $result ? "Het product is succesvol verwijderd" : "Het verwijderen van dit product is niet gelukt";
    } catch (exception $e) {
      throw $e;
    }
  }
}
