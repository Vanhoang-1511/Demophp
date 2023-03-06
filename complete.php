<?php
session_start();

$title = 'Compelete Page';
include_once('layouts/header.php');
require_once('db/dbhelper.php');
require_once('utils/utility.php');

?>
<!-- body START -->
<div class="row">
    <h1>Compelete Checkout </h1>
</div>
<!-- body END -->
<?php
include_once('layouts/footer.php');
?>