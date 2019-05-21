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

    $html .= "<form method='post' action='index.php?op=search'>";
    $html .= "<input type='text' name='search' style='width: 25%;' placeholder='Search for product name or description'>";
    $html .= "<button type='submit' value='search'><span class='glyphicon glyphicon-search'></span></button>";
    $html .= "</form>";
    return $html;
  }

  public function createTable($rows)
  {
    $tableheader = false;
    $html = "";
    $row = "";

    $html .= "<table>";

    foreach ($rows as $row) {
      if ($tableheader == false) {
        $html .= "<tr>";
        foreach ($row as $key => $value) {
          $html .= "<th>{$key}</th>";
        }
        $html .= "<th>actions</th>";
        $html .= "</tr>";
        $tableheader = true;
      }
      foreach ($row as $value) {
        $html .= "<td>{$value}</td>";
      }
      $html .= "<td>" . "<a href='index?op=productDetails&id=" . $row['product_id'] . "'><button><span class='glyphicon glyphicon-book'></span> Read</button></a>" . "<a><button><span class='glyphicon glyphicon-pencil'></span> Update</button></a>" . "<a><button><span class='glyphicon glyphicon-remove'></span> Delete</button></a>" . "</td>";
      $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
  }
}
