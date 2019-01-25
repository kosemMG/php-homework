<?php
/**
 * @var
 */
?>

<?php if ($user_id = $_SESSION['user_id']): ?>
    <h3>The cart:</h3>
    <?php if (empty($cart)): ?>
        <div>The cart is empty.</div>
    <?php else: ?>
        <a href="/cart/clear">Clear cart</a><br><br>
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
                        <a href="/cart/reduce?id=<?= $item->product_id ?>">Reduce</a>
                        <a href="/cart/remove?id=<?= $item->product_id ?>">Remove</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="/order?id=<?= $cart[0]->user_id ?>">Make an order</a>
    <?php endif; ?>
<?php else: ?>
    <div>Please <a href="">enter</a> or <a href="">sign up.</a></div>
<?php endif; ?>
