<?php
session_start();

$title = 'Cart Page';
include_once('layouts/header.php');
require_once('db/dbhelper.php');
require_once('utils/utility.php');

$productList = executeResult('select * from products');
?>
<!-- body START -->
<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Thumbnail</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Num</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <?php
                $cart = [];
                if (isset($_SESSION['cart'])) {
                    $cart = $_SESSION['cart'];
                }
                $count = 0;
                $total = 0;
                foreach ($cart as $item) {
                    $total += $item['num'] * $item['price'];
                    echo '
                <tr>
                    <td>' . (++$count) . '</td>
                    <td>  <img src=" ' . $item['thumbnail'] . '" style="width: 50%"></td>
                    <td>' . $item['title'] . '</td>
                    <td>' . number_format($item['price'], 0, '', '.') . ' Vnđ</td>
                    <td>' . $item['num'] . '</td>
                    <td>' . number_format($item['num'] * $item['price'], 0, '', '.') . ' Vnđ</td>
                    <td><button class="btn btn-danger" onclick="deleteItem(' . $item['id'] . ')">Delete</button></td>
                </tr>';
                }
                ?>

            </tbody>
        </table>
        <p style="font-size: 24px; color: red;">
            <?= number_format($total, 0, '', '.') ?>
        </p>
        <a href="checkout.php">
            <button class="btn btn-success" style="font-size: x-large; width: 100%;">Continue</button>

        </a>
    </div>
</div>
<!-- body END -->
<script type="text/javascript">
    function deleteItem(id) {
        $.post('api/api-product.php', {
            'action': 'delete',
            'id': id
        }, function(data) {
            location.reload()
        })
    }
</script>
<?php
include_once('layouts/footer.php');
?>