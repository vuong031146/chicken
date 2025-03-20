<?php
include_once 'config.php';
if(!isset($_SESSION['username'])){
    header('Location: /auth/login.php');
    exit();
}
require_once 'layouts/header.php';
$acc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `customers` WHERE `username` = '{$_SESSION['username']}'"));
$user_id = $acc['id'];
$total = 0;
?>
<div class="content content-background-color margin-top" style="">
    <div class="container">
        <div class="row sm-gutter">
    <div class="col-12">
                <h2 class="cart-title">Giỏ hàng</h2>
                <div class="cart-table">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            $acc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `customers` WHERE `username` = '{$_SESSION['username']}'"));
                            $user_id = $acc['id'];
                            $sql = "SELECT * FROM `cart` WHERE `customer_id` = '$user_id'";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_assoc($result)){
                                $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = '{$row['product_id']}'"));
                                $total += $product['price'] * $row['quantity'];
                            ?>
                            <tr>
                                <td><?= $stt++ ?></td>
                                <td><img src="<?= $product['image_url'] ?>" alt="" style="width: 100px; height: 100px;" class="cart-product-img"></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td><?= number_format($product['price']) ?>đ</td>
                                <td><?= number_format($product['price'] * $row['quantity']) ?>đ</td>
                                <td><a href="api/cart.php?id=<?= $product['id'] ?>" class="cart-delete">Xóa</a></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">Tổng tiền</td>
                                <td><?= number_format($total) ?>đ</td>
                                <td><button class="btn-tt"><i class="fa-solid fa-cart-shopping"></i> &nbsp;Đặt hàng</button></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>

        </div>
    </div>
</div>
<?php
require_once 'layouts/footer.php';
