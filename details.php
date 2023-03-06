<?php
session_start();
$title = 'Detail Page';

require_once('db/dbhelper.php');
require_once('utils/utility.php');
include_once('layouts/header.php');
$id = getGet('id');
$product = executeResult('select * from products where id = ' . $id, true);
?>
<!-- body -->
<div class="row">
    <div class="col-md-5">
        <img src="<?= $product['thumbnail'] ?>" style="width: 100%">
    </div>
    <div class="col-md-7">
        <p style="font-size: 26px;"><?= $product['title'] ?></p>
        <p style="font-size: 26px; color: red"><?= number_format($product['price'], 0, '', '.') ?> VND</p>
        <button class="btn btn-success" onclick="addToCart(<?= $id ?>)" style="width: 100%; font-size: 26px;">Add to cart</button>
        <a href="checkout.php">
            <button class="btn btn-danger" style="width: 100%; font-size: 26px; margin-top: 10px;">Checkout</button>

        </a>
    </div>
    <div class="col-md-12">
        <?= $product['content'] ?>
    </div>
</div>

<!-- body ENd -->
<!-- sử dụng ajax để add cart vào giỏ hang -->
<script type="text/javascript">
    function addToCart(id) {
        $.post('api/api-product.php', {
            'action': 'add',
            'id': id
        }, function(data) {
            location.reload()
        })
    }
</script>
<?php
include_once('layouts/footer.php');
?>