<?php

// Author: Moshe Gelberg

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

// Task 4

class Clothes extends Product
{
    protected $color;
    protected $size;

    public function __construct($id, $name, $color, $size, $price)
    {
        parent::__construct($id, $name, $price);
        $this->color = $color;
        $this->size = $size;
    }

    public function displayProduct()
    {
        echo "<h3>{$this->name}</h3>";
        echo "<p>The color is: {$this->color}</p>";
        echo "<p>The size is: {$this->size}</p>";
        echo "<p>The price is: &#36;{$this->price}</p>";
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getSize()
    {
        return $this->size;
    }
}

$shirt = new Clothes(3,'Shirt', 'white', 'XL', 29.99);

$shirt->displayProduct();

// Task 5

class A1
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

// Создаются два объекта a1 и а2 класса А1.
$a1 = new A1();
$a2 = new A1();

// В функции foo() объявлена статическая переменая $x. Статические переменные привязаны к классу, а не к объекту,
// и поэтому транслируют свое состояние на все объекты. Т.е., если в одном объекте меняется статическое свойство
// (переменная), то оно меняется во всех объектах сразу. Инициализруется же только в первый раз.
$a1->foo(); // 1
$a2->foo(); // 2
$a1->foo(); // 3
$a2->foo(); // 4

echo "<br>";

// Task 6

class A2
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

// Класс B1 наследует класс A2.
class B1 extends A2
{

}

// Создаются два объекта: a1 класса А2 и b1 класса B1.
$a1 = new A2();
$b1 = new B1();

// Поскольку объекты a1 и b1 являются объектами разных классов, то каждый их них имеет свою статическую переменную $x.
// Соответственно изменение $x в объекте a1 не влияет на $x в объекте b1.
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2

echo "<br>";

// Task 7

class A3
{
    public function foo()
    {
        static $x = 0;
        echo ++$x;
    }
}

class B2 extends A3
{

}

// Создать объект можно и без использования скобок класса.
$a1 = new A3;
$b1 = new B2;

// Соответственно вывод будет точно таким же, как и раньше.
$a1->foo(); // 1
$b1->foo(); // 1
$a1->foo(); // 2
$b1->foo(); // 2