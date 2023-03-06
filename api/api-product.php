<?php
session_start();
if (!empty($_POST)) {

    require_once('../db/dbhelper.php');
    require_once('../utils/utility.php');


    $action = getPOST('action');
    $id = getPost('id');

    switch ($action) {
        case 'add':
            addToCart($id);
            break;
        case 'delete':
            deleteItem($id);
            break;
    }
}

function addToCart($id)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFind = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            $cart[$i]['num']++;
            $isFind = true;
            break;
        }
    }
    if (!$isFind) {
        $product = executeResult('select * from products where id = ' . $id, true);
        $product['num'] = 1;
        $cart[] = $product;
    }

    //update session
    $_SESSION['cart'] = $cart;
}
// xóa item
function deleteItem($id)
{
    $cart = [];
    if (isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
    }
    $isFind = false;
    for ($i = 0; $i < count($cart); $i++) {
        if ($cart[$i]['id'] == $id) {
            array_splice($cart, $i, 1);
            break;
        }
    }
    //update session
    $_SESSION['cart'] = $cart;
}
