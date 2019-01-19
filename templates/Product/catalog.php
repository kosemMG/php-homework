<?php
/**
 * @var \app\models\entities\Product $products
 */
?>

<h1>Catalog</h1>
<?php foreach ($products as $product): ?>
    <a href="/product/card/?id=<?= $product->id ?>">
        <img src="<?= $product->img_path ?>" alt="product">
        <h2><?= $product->name ?></h2>
        <p><?= $product->price ?></p>
    </a>
<?php endforeach; ?>
