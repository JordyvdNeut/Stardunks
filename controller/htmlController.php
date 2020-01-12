<?php
class HtmlController
{
  public function __construct()
  { }

  public function __destruct()
  { }

  public function search()
  {
    $html = "";

    $html .= "<div class='form-group row' style='width: 100%;'>";
    $html .= "<form method='post' action='index.php?op=search'>";
    $html .= "<div class='col-md-8'><input class='form-control' style='margin-top: 10px;' type='text' name='search' placeholder='Search for product name or description'/></div>";
    $html .= "<div class='col'><button class='btn btn-primary' style='margin-top: 10px; type='submit' value=''><span class=' glyphicon glyphicon-search'></span></button></div>";
    $html .= "</form>";
    $html .= "<div class='col float-right' style='float: right; text-align: end;><a href='index.php?op=askDeleteProducts'><button class='btn'>Delete selected</button></a></div>";
    $html .= "<div class='col float-right' style='float: right;'><a href='index.php?op=getProductForm'><button class='btn'>create product</button></a></div>";
    $html .= "</div>";
    return $html;
  }

  public function createTable($rows)
  {
    $tableheader = false;
    $html = "";
    $row = "";

    $html .= "<table  class='table'>";

    foreach ($rows as $row) {
      $row['product_price'] = '€ ' . str_replace('.', ',', $row['product_price']);
      $html .= "<tr>";
      if ($tableheader == false) {
        $html .= "<th><input type='checkbox'></th>";
        foreach ($row as $key => $value) {
          $html .= "<th>{$key}</th>";
        }
        $html .= "<th>actions</th>";
        $html .= "</tr>";
        $tableheader = true;
      }
      $html .= "<td><input type='checkbox' name='check' value='" . $row['product_id'] . "'></td>";
      foreach ($row as $value) {
        $html .= "<td>{$value}</td>";
      }
      $html .= "<td>" . "
      <a href='index.php?op=productDetails&id=" . $row['product_id'] . "'><button><span class='glyphicon glyphicon-book'></span> Read</button></a>" . "
      <a href='index.php?op=updateProductForm&id=" . $row['product_id'] . "'><button><span class='glyphicon glyphicon-pencil'></span> Update</button></a>" . "
      <a href='index.php?op=askDeleteProduct&id=" . $row['product_id'] . "'><button><span class='glyphicon glyphicon-remove'></span> Delete</button></a>" . "</td>";
      $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
  }
}
