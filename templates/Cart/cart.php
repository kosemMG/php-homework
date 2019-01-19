<?php
/**
 * @var
 */
?>

<h3>The cart:</h3>
<?php if (empty($cart)): ?>
    <div>The cart is empty.</div>
<?php else: ?>
<a href="/cart/clear">Clear cart</a>
    <table>
        <tr>
            <th>Image</th>
            <th>Product name</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php foreach ($cart as $item): ?>
            <tr>
                <td><img src="<?= $item->image_path ?>" alt="product"></td>
                <td><?= $item->name ?></td>
                <td><?= $item->amount ?></td>
                <td>&#36;&nbsp;<?= $item->price ?></td>
                <td>
                    <a href="/cart/reduce/?id=<?= $item->product_id ?>">Reduce</a>
                    <a href="/cart/remove/?id=<?= $item->product_id ?>">Remove</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>