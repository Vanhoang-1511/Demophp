<?php
session_start();

$title = 'Checkout Page';
include_once('layouts/header.php');
require_once('db/dbhelper.php');
require_once('utils/utility.php');
require_once('api/form-checkout.php');

$productList = executeResult('select * from products');
?>
<!-- body START -->

<form style="margin-top: 20px;" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="mb-3">
                <label for="fullname" class="form-label">FullName</label>
                <input required="true" type="text" class="form-control" id="fullname" name="fullname">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input required="true" type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">Phone Number</label>
                <input required="true" type="tel" class="form-control" id="phone_number" name="phone_number">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Addres</label>
                <input required="true" type="text" class="form-control" id="address" name="address">
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Thumbnail</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Num</th>
                        <th>Total</th>
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
                    <td>' . number_format($item['num'] * $item['price'], 0, '', '.') . '.000 Vnđ</td>
                </tr>';
                    }
                    ?>

                </tbody>
            </table>
            <p style="font-size: 24px; color: red;">
                <?= number_format($total, 0, '', '.') ?>.000 VND
            </p>
            <button class="btn btn-success" style="font-size: x-large; width: 100%;margin-top: 15px;">Complete</button>
        </div>
    </div>
</form>
<!-- body END -->
<?php
include_once('layouts/footer.php');
?>