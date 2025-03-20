<?php
require_once '../config.php';
if(empty($_SESSION['username']) || $account['role'] != 1){
    header('Location: /auth/login.php');
    exit();
}

$edit = isset($_GET['edit']) ? intval($_GET['edit']) : null;
$delete = isset($_GET['delete']) ? intval($_GET['delete']) : null;

if(!$edit && !$delete) {
    header('Location: /');
    exit();
}

if(isset($edit)) {
    if(isset($_POST['submit'])) {
        $customer_id = mysqli_real_escape_string($conn, addslashes($_POST['customer_id']));
        if($customer_id == ''){
            $customer_id = '0';
        }
        $product_id = mysqli_real_escape_string($conn, addslashes($_POST['product_id']));
        $quantity = mysqli_real_escape_string($conn, addslashes($_POST['quantity']));
        $status = mysqli_real_escape_string($conn, addslashes($_POST['status']));
        $price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = $product_id"))['price'];
        $total_price = $quantity * $price;

        $sql = "UPDATE orders SET customer_id = '{$customer_id}', product_id = '{$product_id}', quantity = '{$quantity}', status = '{$status}', total_price = '{$total_price}' WHERE id = '{$edit}'";
        if (mysqli_query($conn, $sql)) {
            $status = true;
            $msg = "Cập nhật thành công";
        } else {
            $status = false;
            $msg = "Lỗi cập nhật: " . mysqli_error($conn);
        }
    }
}

if(isset($delete)) {
    $sql = "DELETE FROM orders WHERE id = '{$delete}'";
    if (mysqli_query($conn, $sql)) {    
        $status = true;
        $msg = "Xóa thành công";
    } else {
        $status = false;
        $msg = "Lỗi xóa: " . mysqli_error($conn);
    }
}

require_once 'header.php';

if ($msg) {
?>
<script>
        <?php if($status === true){?>
            Swal.fire({
                title: 'Thông báo',
                text: '<?= $msg; ?>',
                icon: 'success'
            });
            setTimeout(() => {
                window.location.href = '/admin/index.php';
            }, 1000);
        <?php }else{ ?>
            Swal.fire({
                title: 'Thông báo',
                text: '<?= $msg; ?>',
                icon: 'error'
            });
        <?php } ?>
</script>
<?php
}
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    Sửa đơn hàng <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="card-body">
                    <?php
                    $sql = "SELECT * FROM orders WHERE id = '$edit'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="#" method="post">
                        <div class="form-group mt-3">
                            <label for="customer_id">Khách hàng</label>
                            <select class="form-control custom-select" id="customer_id" name="customer_id">
                                <option value="">Chọn khách hàng (Để trống nếu khách hàng mới)</option>
                                <?php
                                $sql = "SELECT * FROM customers";
                                $result = mysqli_query($conn, $sql);
                                while ($customer = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?= $customer['id'] ?>" <?= $customer['id'] == $row['customer_id'] ? 'selected' : '' ?>><?= $customer['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>


                        </div>
                        <div class="form-group mt-3">
                            <label for="product_id">Sản phẩm</label>    
                            <select class="form-control custom-select" id="product_id" name="product_id" required>
                                <option value="">Chọn sản phẩm</option>
                                <?php
                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);
                                while ($product = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?= $product['id'] ?>" <?= $product['id'] == $row['product_id'] ? 'selected' : '' ?>><?= $product['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= number_format($row['quantity']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="total_price">Tổng tiền</label>
                            <input type="text" class="form-control" id="total_price" name="total_price" value="<?= number_format($row['total_price']) ?> VNĐ" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="status">Trạng thái</label>
                            <select class="form-control custom-select" id="status" name="status" required>
                                <option value="pending" <?= $row['status'] == 'pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
                                <option value="processing" <?= $row['status'] == 'processing' ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="completed" <?= $row['status'] == 'completed' ? 'selected' : '' ?>>Đã hoàn thành</option>
                                <option value="cancelled" <?= $row['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                            </select>
                        </div>


                        <div class="form-group mt-3">
                            <button type="submit" name="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php   
require_once 'footer.php';
?>

