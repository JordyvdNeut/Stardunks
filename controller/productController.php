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
				case 'updateProductForm':
					$this->collectUpdateFrom($_REQUEST['id']);
					break;
				case 'updateProduct':
					$this->updateProduct($_REQUEST);
					break;
				case 'askDeleteProduct':
					$this->askDeleteProduct($_REQUEST['id']);
					break;
				case 'deleteProduct':
					$this->deleteProduct($_REQUEST['id']);
					break;
				case 'read':
					if ($_REQUEST['p']) {
						$this->collectReadProducts($_REQUEST['p']);
					} else {
						$this->collectReadProducts(0);
					}
					break;
				default:
					$this->collectReadProducts(1);
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
		$products = $this->productsLogic->searchProduct($_REQUEST['search']);
		$productsSearch = $this->htmlController->search();
		include 'view/products.php';
	}

	public function collectReadProducts($position)
	{
		$products = $this->productsLogic->readProducts($position);
		$productsSearch = $this->htmlController->search();
		include 'view/products.php';
	}

	public function collectUpdateFrom($id)
	{
		$productDetails = $this->productsLogic->readProduct($id);
		include 'view/updateForm.php';
	}
	public function updateProduct($formData)
	{
		$feedback = $this->productsLogic->updateProduct($formData);
		include 'view/feedback.php';
	}
	public function askDeleteProduct($id)
	{
		$productInfo = $this->productsLogic->readProduct($id);
		$product = $productInfo->fetch(PDO::FETCH_ASSOC);
		include 'view/askDel.php';
		return $product;
	}
	public function deleteProduct($id)
	{
		$feedback = $this->productsLogic->deleteProduct($id);
		include 'view/feedback.php';
	}
}
