<?php
/**
 * @var
 */
?>

<h3>The cart:</h3>
<?php if (empty($cart)): ?>
    <div>The cart is empty.</div>
<?php else: ?>
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
                <td><img src="<?= @$item->image_path ?>" alt="product"></td>
                <td><?= @$item->name ?></td>
                <td><?= @$item->amount ?></td>
                <td>&#36;&nbsp;<?= @$item->price ?></td>
                <td><a href="#">Remove</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>