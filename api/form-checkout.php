<?php
if (!empty($_POST)) {
    $fullname = getPost('fullname');
    $address = getPost('address');
    $email = getPost('email');
    $phone_number = getPost('phone_number');
    $order_date = getPost('Y-m-d H:i:s');


    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    if ($cart == null || count($cart) == 0) {
        header('Location: products.php');
        die();
    }

    $sql = "insert into orders (fullname,address,email,phone_number,order_date) values('$fullname','$address','$email','$phone_number','$order_date')";
    execute($sql);

    $sql = "select id from orders where order_date = '$order_date'";
    $order = executeResult($sql, true);
    $orderId = $order['id'];

    foreach ($cart as $item) {
        $product_id = $item['id'];
        $num = $item['num'];
        $price = $item['price'];
        $sql = "insert into order_details(order_id,product_id, num , price) values ($orderId, $product_id,$num,$price)";
        execute($sql);
    }
    session_destroy();
    header('Location: complete.php');
    die();
}
