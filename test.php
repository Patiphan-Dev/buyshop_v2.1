<div class="col-md-12 col-sm-12 mt-2" data-aos="zoom-in-down">
    <ol class="breadcrumb mt-3 crad_tung text-white">
        <li class="breadcrumb-item text-white hvr-shrink pointer" onclick="CradURL('./page/home')">หน้าแรก</li>
        <li class="breadcrumb-item text-white active">รายการสินค้า</li>
    </ol>
</div>

<?php
$result_category = $connect->query("SELECT * FROM tbl_game WHERE typegame = 'card';");
$res_categorys = $result_category->fetch_all(MYSQLI_ASSOC);
$i = 1;
?>
<style>
    .cardCategory {
        background-color: white;
        color: white !important;
        border-radius: 6px;
    }

    .cardCategory .active,
    .cardCategory:hover,
    .cardCategory:focus {
        /* background-color: white; */
        color: black !important;
        border-radius: 6px;
        color: #fff !important;
    }

    .dropdown a {
        color: #fff !important;
        font-size: 20px;
    }
</style>
<!-- <div class="col-12 col-sm-3 col-md-3">
    <h5 class="card-header text-white mb-3"><i class="fa-solid fa-box-open"></i> หมวดหมู่บัตรเติมเงิน</h5>
    <?php foreach ($res_categorys as $res_category) : ?>
        <div class="col-12 mb-3 hvr-float pointer 
    " onclick="CradURL('./category_card/<?= $res_category['id'] ?>')">
            <div class="card crad_tung card_new <?php if (!empty($_GET['category'])) {
                                                    if ($res_category['id'] == $_GET['category']) {
                                                        echo 'cardCategory active';
                                                    }
                                                } ?>">
                <div class="row p-1">
                    <div class="col-4">
                        <img src="assets/img/game_icon/<?= $res_category['img'] ?>" alt="<?= $res_category['img'] ?>" class="w-100" style="max-width: 40px;">
                    </div>
                    <div class="col-8">
                        <h5><?= $res_category['name'] ?></h5>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div> -->

<div class="dropdown mt-4">
    <a class="hvr-icon-up nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        <i class="fa-solid fa-box-open hvr-icon" style="color:#FFC100;"></i> หมวดหมู่บัตรเติมเงิน
    </a>
    <div class="dropdown-menu py-0" style="max-width:300px">
        <?php foreach ($res_categorys as $res_category) : ?>
            <!-- <a class="dropdown-item hvr-icon-up " href="page/shop"><i class="fa-solid fa-file-lines hvr-icon" style="color:#000;"></i> ร้านค้าไอดี</a> -->
            <div class="dropdown-item hvr-float pointer cardCategory <?php if (!empty($_GET['category'])) {
                                                                            if ($res_category['id'] == $_GET['category']) {
                                                                                echo 'active';
                                                                            }
                                                                        } ?>" onclick="CradURL('./category_card/<?= $res_category['id'] ?>')">
                <!-- <div class="card crad_tung card_new"> -->
                <div class="row p-1">
                    <div class="col-4">
                        <img src="assets/img/game_icon/<?= $res_category['img'] ?>" alt="<?= $res_category['img'] ?>" class="w-100" style="max-width: 30px;">
                    </div>
                    <div class="col-8">
                        <h6><?= $res_category['name'] ?></h6>
                    </div>
                </div>
                <!-- </div> -->
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
if (isset($_GET['category'])) {
    $idcategory = $connect->real_escape_string(@$_GET['category']);
    $result = $connect->query("SELECT * FROM tbl_shop_id WHERE gameid = '" . $idcategory . "' AND status != '0' AND shoptype = 'card'  ORDER BY status ASC");
} else {
    $result = $connect->query("SELECT * FROM tbl_shop_id WHERE status != '0' AND shoptype = 'card' ORDER BY status ASC");
}

if ($result->num_rows == 0) {
    echo '<div class="col-md-9 col-sm-9 col-12 mt-5" data-aos="zoom-in-down">
            <div class="alert alert-dismissible alert-danger">
                <strong>ยังไม่มีสินค้าตอนนี้!</strong> <a href="page/card" class="alert-link">ร้านค้า</a>.
            </div>
        </div>';
} else if (empty($_GET['category'])) {
    echo '<div class="col-md-9 col-sm-9 col-12 mt-5" data-aos="zoom-in-down">
            <div class="alert alert-dismissible alert-danger">
                <strong>กรุณาเลือกหมวดหมู่ที่ต้องการ!</strong>
            </div>
        </div>';
} else {

?>

    <div class="row justify-content-center mt-4" data-aos="zoom-in-down">
        <div class="col-12 col-md-10 colsm-10">
            <div class="row justify-content-center">
                <div class="col-md-4 col-sm-4 col-6 text-center">
                    <?php
                    $id = $connect->real_escape_string($_GET['category']);
                    $result_game = $connect->query('SELECT * FROM `tbl_game` WHERE `id` = "' . $id . '" ')->fetch_assoc();

                    ?>
                    <center>
                        <div class="card-online"><img class="w-100 text-center" src="assets/img/game_icon/<?= $result_game['img'] ?>" alt="<?= $result_game['img'] ?>"></div>
                    </center>
                    <div class="text-center">
                        <h2 class="card-title"><?= $result_game['name'] ?> CARD</h2>
                    </div>
                </div>
                <div class="col-md-8 col-sm-8 col-12">
                    <h4 class="mt-3 mb-0 pb-0 text-white" style="color: red;">เลือกบัตรที่ต้องการ *</h4>
                    <small style="color: red;"><i class="fas fa-exclamation-circle red"></i> โปรดระวัง ! บัตรเงินสดไม่สามารถเปลี่ยนสินค้าหรือคืนเงินได้ <span class="red required">*</span></small>
                    <div class="card-listlink">
                        <p class="mb-0">เติมเเงินค่าย <?= $result_game['name'] ?></p>
                    </div>
                    <hr>
                    <div class="row">
                        <?php $shop_fetchs = $result->fetch_all(MYSQLI_ASSOC);
                        foreach ($shop_fetchs as $shop_fetch) :
                            $img_shop = explode(',', $shop_fetch['img']);
                            $account_info_shop = $connect->query("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = '" . $shop_fetch['id'] . "' ORDER BY id ASC");
                            $num_account_info_shop = $account_info_shop->num_rows;
                        ?>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="card-price text-center radius-border-2 p-2 mb-4 pointer" style="background-color: white;" onclick="buyaccount(<?= $shop_fetch['id'] ?>)">

                                    <?php if (@$users_status == $vip_status) : ?>
                                        <?= $shop_fetch['pointv'] ?>
                                    <?php else : ?>
                                        <?= $shop_fetch['point'] ?>
                                    <?php endif; ?> บาท <br>
                                    <small><i class="fa-solid fa-file-csv"></i> คงเหลือ <b><?= $num_account_info_shop ?> </b>ชิ้น</small>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="row text-center mt-2">
                        <small style="color: white;"><span style="color: red;">***</span> กดที่จำนวนเงินเพื่อสั่งซื้อ</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- <div class="col-md-3 col-sm-12 col-12 px-2 d-flex align-items-stretch hvr-float pointer" onclick="CradURL('./shop/<?= $shop_fetch['id'] ?>')">
            <div class="card crad_tung mb-3 card_new" data-aos="fade-up">
                <img src="<?= $img_shop[0] ?>" alt="shop" class="mb-3">
                <div class="card-body d-flex flex-column text-white">
                    <h4><?= $shop_fetch['name'] ?></h4>
                    <small><i class="fa-brands fa-creative-commons-share"></i> รหัสสินค้า A00<?= $shop_fetch['id'] ?></small>
                    <small><i class="fa-regular fa-circle-user"></i> โพสต์โดย <?= $shop_fetch['username'] ?></small>
                    <small><i class="fa-regular fa-clock"></i> เมื่อเวลา <?= th($shop_fetch['timeadd']) ?></small>
                    <?php //add get gif code
                    $account_info_shop = $connect->query("SELECT * FROM `tbl_shop_stock` WHERE `shopid` = '" . $shop_fetch['id'] . "' ORDER BY id ASC");
                    $num_account_info_shop = $account_info_shop->num_rows;
                    ?>
                    <small><i class="fa-solid fa-file-csv"></i> สินต้าคงเหลือ <b><?= $num_account_info_shop ?> </b>บัญชี</small>
                </div>
                <div class="p-2">


                </div>
            </div>
        </div> -->


<?php } ?>

<?php include 'view/view_shophot.php'; ?>