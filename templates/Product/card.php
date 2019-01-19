<?php
/**
 * @var \app\models\entities\Product $product
 */
?>

<img src="<?= $product->img_path ?>" alt="product">
<h1><?= $product->name ?></h1>
<p><?= $product->description ?></p>
<a href="/cart/add/?id=<?= $product->id ?>">Add to cart</a>