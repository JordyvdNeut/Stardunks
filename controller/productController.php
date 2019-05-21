<?php
require_once 'model/productsLogic.php';
require_once 'controller/htmlController.php';

class ProductsController
{
	public function __construct()
	{
		$this->productsLogic = new ProductsLogic();
		$this->htmlController = new HtmlController();
	}

	public function __destruct()
	{ }
	public function handleRequest()
	{
		try {
			$op = isset($_REQUEST['op']) ? $_REQUEST['op'] : NULL;
			switch ($op) {
				case 'getProductForm':
					$this->collectCreateProductForm();
					break;
				case 'search':
					$this->collectSearchProduct();
					break;
				case 'createProduct':
					$this->collectCreateProduct();
					break;
				case 'productDetails':
					$this->collectProduct($_REQUEST['id']);
					break;
				default:
					$this->collectReadProducts();
					break;
			}
		} catch (ValidationException $e) {
			$errors = $e->getErrors();
		}
	}
	public function collectCreateProductForm()
	{
		include 'view/createProductForm.php';
	}
	public function collectCreateProduct()
	{
		$formData = $_REQUEST;
		$createProduct = $this->productsLogic->createProduct($formData);
		include 'view/createProduct.php';
	}
	public function collectProduct($id)
	{
		$productDetails = $this->productsLogic->readProduct($id);
		include 'view/productDetail.php';
	}
	public function collectSearchProduct()
	{
		$search = $_REQUEST;
		$products = $this->productsLogic->searchProduct($search);
		$productsSearch = $this->htmlController->search();
		$productsTable = $this->htmlController->createTable($products);
		include 'view/products.php';
	}

	public function collectReadProducts()
	{
		$products = $this->productsLogic->readProducts();
		$productsSearch = $this->htmlController->search();
		include 'view/products.php';
	}
}
