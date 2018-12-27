<?php

// Task 1, 2, 3

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $expired_date;

    public function __construct($id, $name, $price, $expired_date = null)
    {
//        foreach ($parameters as $parameter => $value) {
//            if (property_exists(__CLASS__, $parameter)) {
//                $this->$parameter = $value;
//            }
//        }
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->expired_date = $expired_date;
    }

    public function displayProduct()
    {
        echo "<h3>{$this->name}</h3>";
        echo "<p>The price is: &#36;{$this->price}</p>";
        echo "<p>Expired on: {$this->expired_date}";
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getExpiredDate()
    {
        return $this->expired_date;
    }
}

$bread = new Product(1,'Bread', 2.99, date("Y.m.d", time() + (14 * 24 * 3600)));
$milk = new Product(2,'Milk', 1.95, date("Y.m.d", time() + (5 * 24 * 3600)));

$bread->displayProduct();
$milk->displayProduct();
