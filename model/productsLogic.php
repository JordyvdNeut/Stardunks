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

  public function readProducts()
  {
    try {
      $items_per_page = 4;
      $position = ((1 - 1) * $items_per_page);
      $sql = 'SELECT * FROM products LIMIT ' . $position . ', ' . $items_per_page;
      $res = $this->DataHandler->readsData($sql);
      $result = $this->euroSign($res);
      $results = $this->HtmlController->createTable($result);
      $pages = $this->DataHandler->countPages('SELECT COUNT(*) FROM products');
      return array($pages, $results);
    } catch (exception $e) {
      throw $e;
    }
  }

  public function searchProduct($search)
  {
    $search_value = $search["search"];
    $sql = "SELECT * FROM products WHERE product_name LIKE '%$search_value%' OR other_product_details LIKE '%$search_value%'";
    $res = $this->DataHandler->readsData($sql);
    $result = $this->euroSign($res);
    return $result;
  }

  public function readProduct($id)
  {
    try {
      $sql = "SELECT * FROM products WHERE product_id = " . $id;
      $res = $this->DataHandler->readsData($sql);
      $result = $this->euroSign($res);
      return $result;
    } catch (exception $e) {
      throw $e;
    }
  }

  public function createProduct($formData)
  {
    $product_type_code = $formData["product_type_code"];
    $supplier_id = $formData["supplier_id"];
    $product_name = $formData["product_name"];
    $product_price = $formData["product_price"];
    $other_product_details = $formData["other_product_details"];

    try {
      $sql = "INSERT INTO products (product_id, product_type_code, supplier_id, product_name, product_price, other_product_details)
        VALUES ('' ,'$product_type_code' ,'$supplier_id' ,'$product_name' ,'$product_price' ,'$other_product_details')";
      $result = $this->DataHandler->createData($sql);
      return $result = 1 ? "Product succesvol aangemaakt" : "Er is wat fout gegaan bij het aanmaken van het product";
    } catch (exception $e) {
      throw $e;
    }
  }
}
