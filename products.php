<?php
session_start();

$title = 'Product Page';
include_once('layouts/header.php');
require_once('db/dbhelper.php');
require_once('utils/utility.php');

?>
<!-- body START -->
<div class="row">
    <?php
    $productList =  executeResult("select count(id) as number from products");
    $number  = 0;
    if ($productList != null && count($productList) > 0) {
        $number = $productList[0]['number'];
    }
    $pages = ceil($number / 8); //số trang cân có trong hệ thống
    $current_page = 1;
    if (isset($_GET['page'])) {
        $current_page = $_GET['page'];
    }
    $index  = ($current_page - 1) * 8; //nhân 8 : nó sẽ ra dc vị trí mà nó muốn lấy 
    //vd : trang 1  (1 - 1) *8  = 0 : vị trí bắt đầu là = 0
    //  trang 2    (2-1) *8 = 8 : vị trí trang thứ 2 lấy bắt đầu từ thứ 8


    //hàm limit 0 , 8 : vị trí bắt đầu là 0 và lấy 8 sản phẩm là dừng

    $productList = executeResult('select * from products limit ' . $index . ', 8');
    foreach ($productList as $item) {
        echo '<div class="col-md-3" style="border: solid 2px #e9e6e6; margin-top: 10px;">
			<a  href="details.php?id=' . $item['id'] . '"><img src="' . $item['thumbnail'] . '" style="width: 100% ;text-decoration: none;"></a>
			<a href="details.php?id=' . $item['id'] . '"><p style="font-size: 26px;">' . $item['title'] . '</p></a>
			<p style="font-size: 26px; color: red">' . number_format($item['price'], 0, '', '.') . ' VND</p>
		</div>';
    }
    ?>

</div>
<nav aria-label="...">
    <ul class="pagination">
        <?php
        for ($i = 1; $i <= $pages; $i++) {
            echo '
            
            <li class="page-item"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>
            ';
        }
        ?>

    </ul>
</nav>
<!-- body END -->
<?php
include_once('layouts/footer.php');
?>