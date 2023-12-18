<div class="col mt-2">
    <div class="card mb-3">
        <div class="card-header"><i class="fa-solid fa-caret-right" style="color:#F186A9;"></i> Manage Shop - จัดการสินค้า</div>
        <div class="card-body p-4">

            <a class="btn btn-primary mb-2" href="?page=manage&admin=manageshop">ทั้งหมด</a>
            <a class="btn btn-primary mb-2" href="?page=manage&admin=manageshop&t=id">ไอดีเกม</a>
            <a class="btn btn-primary mb-2" href="?page=manage&admin=manageshop&t=account">บัญขี</a>
            <a class="btn btn-primary mb-2" href="?page=manage&admin=manageshop&t=card">บัตรเติมเงิน</a>
            <div class="table-responsive">
                <table id="tbl_history_shop" cellspacing="1" class="table table-striped table-bordered display text-white">
                    <thead class="mt-3">
                        <tr>
                            <th>#</th>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th><i class="fa-solid fa-clock"></i> ประเภท</th>
                            <th><i class="fa-solid fa-clock"></i> เวลาลงขาย</th>
                            <th><i class="fa-solid fa-font-awesome"></i> ราคาปกติ</th>
                            <th><i class="fa-solid fa-font-awesome"></i> ราคาพิเศษ</th>
                            <th><i class="fa-solid fa-chart-column"></i> แนะนำ</th>
                            <th><i class="fa-solid fa-chart-column"></i> สถานะ</th>
                            <th><i class="fa-solid fa-pen-to-square"></i> จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        if (@$_GET['t'] == "id") {
                            $type_sql = "idgame";
                            $result_shop = $connect->query("SELECT * FROM tbl_shop_id WHERE shoptype = '" . $type_sql . "';");
                        } else if (@$_GET['t'] == "account") {
                            $type_sql = "account";
                            $result_shop = $connect->query("SELECT * FROM tbl_shop_id WHERE shoptype = '" . $type_sql . "';");
                        } else if (@$_GET['t'] == "card") {
                            $type_sql = "card";
                            $result_shop = $connect->query("SELECT * FROM tbl_shop_id WHERE shoptype = '" . $type_sql . "';");
                        } else {
                            $result_shop = $connect->query("SELECT * FROM tbl_shop_id;");
                        }

                        $res_shops = $result_shop->fetch_all(MYSQLI_ASSOC);
                        $i = 1;
                        foreach ($res_shops as $res_shop) :  ?>
                            <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td class="text-center">A00<?= $res_shop['id'] ?></td>
                                <td><?= $res_shop['name'] ?></td>
                                <td><?= $res_shop['shoptype'] ?></td>
                                <td><?= th($res_shop['timeadd']) ?></td>
                                <td class="text-end"><?= number_format($res_shop['point'], 2) ?></td>
                                <td class="text-end">
                                    <?php if ($res_shop['pointv'] != '') {
                                        echo number_format($res_shop['pointv'], 2);
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($res_shop['top'] == 1) {
                                        echo '<i class="fa-solid fa-toggle-on fa-xl pointer" style="color:#08B000;" onclick="on_top(' . $res_shop['id'] . ')"></i>';
                                    } else {
                                        echo '<i class="fa-solid fa-toggle-off fa-xl pointer" style="color:#A0A0A0;" onclick="on_top(' . $res_shop['id'] . ')"></i>';
                                    }
                                    ?>

                                </td>
                                <td class="text-center">
                                    <?php
                                    if ($res_shop['status'] == 1) {
                                        echo '<i class="fa-solid fa-toggle-on fa-xl pointer" style="color:#08B000;" onclick="on_show(' . $res_shop['id'] . ')"></i> แสดง';
                                    } else if ($res_shop['status'] == 2) {
                                        echo '<i class="fa-solid fa-toggle-off fa-xl pointer" style="color:#B90000;" onclick="on_show(' . $res_shop['id'] . ')"></i> ขายแล้ว';
                                    } else {
                                        echo '<i class="fa-solid fa-toggle-off fa-xl pointer" style="color:#A0A0A0;" onclick="on_show(' . $res_shop['id'] . ')"></i> ซ่อน';
                                    }
                                    ?>

                                </td>
                                <td class="text-center">
                                    <?php if ($res_shop['shoptype'] == "account" || $res_shop['shoptype'] == "card") : ?>
                                        <a href="?page=manage&admin=addaccount&id=<?= $res_shop['id'] ?>" class="btn btn-success btn-sm mb-2"><i class="fa-solid fa-folder-plus"></i> เพิ่มบัญชี</a>
                                    <?php endif; ?>

                                    <a href="?page=manage&admin=editshop&id=<?= $res_shop['id'] ?>" class="btn btn-primary btn-sm mb-2"><i class="fa-solid fa-pen-to-square"></i> แก้ไช</a>
                                    <button onclick="delete_shop_id(<?= $res_shop['id'] ?>)" class="btn btn-danger btn-sm mb-2"><i class="fa-solid fa-trash"></i> ลบ</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>