<?php
require_once '../config.php';
if(empty($_SESSION['username']) && $account['role'] != 1){
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
        $name = mysqli_real_escape_string($conn, addslashes($_POST['name']));
        $phone = mysqli_real_escape_string($conn, addslashes($_POST['phone']));
        $email = mysqli_real_escape_string($conn, addslashes($_POST['email']));
        $address = mysqli_real_escape_string($conn, addslashes($_POST['address']));
        $password = mysqli_real_escape_string($conn, addslashes($_POST['password']));
        $role = mysqli_real_escape_string($conn, addslashes($_POST['role']));
        $sql = "UPDATE customers SET name = '{$name}', phone = '{$phone}', email = '{$email}', address = '{$address}', password = '{$password}', role = '{$role}' WHERE id = '{$edit}'";
        if (mysqli_query($conn, $sql)) {
            $status = true;
            $msg = "Cập nhật thành công";
        } else {
            $status = false;
            $msg = "Lỗi cập nhật: " . mysqli_error($conn);
        }
    }
}

if(!empty($delete)) {
    $sql = "DELETE FROM customers WHERE id = '{$delete}'";
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
                    Thông tin khách hàng <i class="fa-solid fa-user-pen"></i>
                </div>
                <div class="card-body">
                    <?php
                    $sql = "SELECT * FROM customers WHERE id = '$edit'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="#" method="post">
                        <div class="form-group mt-3">
                            <label for="username">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" placeholder="Tên đăng nhập" name="username" value="<?= htmlspecialchars($row['username']) ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" placeholder="Mật khẩu" name="password" value="<?= htmlspecialchars($row['password']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="role">Quyền</label>
                            <select class="form-control custom-select" id="role" name="role">
                                <option value="1" <?= $row['role'] == '1' ? 'selected' : '' ?>>Admin</option>
                                <option value="0" <?= $row['role'] == '0' ? 'selected' : '' ?>>Khách hàng</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name">Tên khách hàng</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên khách hàng" value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="phone">Số điện thoại</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="<?= htmlspecialchars($row['phone']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="address">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" placeholder="Địa chỉ" required><?= htmlspecialchars($row['address']) ?></textarea>
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

