<?php
/**
 * @var \app\models\entities\Product $product
 */
?>

<img src="<?= $product->img_path ?>" alt="product">
<h1><?= $product->name ?></h1>
<p><?= $product->description ?></p>
<form action="/cart/add" method="post">
    <input type="number" name="amount"><br><br>
    <input type="hidden" name="id" value="<?= $product->id ?>">
    <input type="submit" value="Add to cart">
</form>
<!--<a href="/cart/add/?id=--><?//= $product->id ?><!--">Add to cart</a>-->