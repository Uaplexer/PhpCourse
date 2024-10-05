<?php
class Product {
    public $name;
    public $description;
    protected $price;

    public function __construct($name, $description, $price) {
        $this->name = $name;
        $this->description = $description;
        try {
            $this->setPrice($price);
        } catch (Exception $e) {

        }
    }

    /**
     * @throws Exception
     */
    public function setPrice($price) {
        if ($price < 0) throw new Exception("The price can't be negative");
        $this->price = $price;
    }

    public function getInfo() {
        return "Name: {$this->name}\nPrice: {$this->price}\nDesc: {$this->description}\n";
    }
}


class DiscountedProduct extends Product
{
    private $discount;

    public function __construct($name, $description, $price, $discount)
    {
        parent::__construct($name, $description, $price);
        $this->discount = $discount;
    }

    public function getDiscountedPrice()
    {
        return $this->price - ($this->price * $this->discount / 100);
    }

    public function getInfo()
    {
        $originalInfo = parent::getInfo();
        $discountedPrice = $this->getDiscountedPrice();
        return $originalInfo . "Discount: {$this->discount}%\nPrice with discount: {$discountedPrice}\n";
    }
}


class Category
{
    public $name;
    private $products = [];

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        echo "Category: {$this->name}\n";
        foreach ($this->products as $product) {
            echo $product->getInfo();
            echo "-------------------\n";
        }
    }
}


$product1 = new Product("Item1", "Desc1", 10000);
$product2 = new DiscountedProduct("Item2", "Desc2", 30000, 10);

$category = new Category("Category");

$category->addProduct($product1);
$category->addProduct($product2);

$category->getProducts();
