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
        $name = mysqli_real_escape_string($conn, addslashes($_POST['name']));
        $price = mysqli_real_escape_string($conn, addslashes($_POST['price']));
        $status = mysqli_real_escape_string($conn, addslashes($_POST['status']));
        $category = mysqli_real_escape_string($conn, addslashes($_POST['category']));   
        $image_url = mysqli_real_escape_string($conn, addslashes($_POST['image_url']));
        $description = mysqli_real_escape_string($conn, addslashes($_POST['description']));
        $sql = "UPDATE products SET name = '{$name}', price = '{$price}', status = '{$status}', category = '{$category}', image_url = '{$image_url}', description = '{$description}' WHERE id = '{$edit}'";
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
    $sql = "DELETE FROM products WHERE id = '{$delete}'";
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
                    Thông tin sản phẩm <i class="fa-solid fa-box-open"></i>
                </div>
                <div class="card-body">
                    <?php
                    $sql = "SELECT * FROM products WHERE id = '$edit'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <form action="#" method="post">
                        <div class="form-group mt-3">
                            <label for="name">Tên sản phẩm</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="price">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($row['price']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="category">Danh mục</label>
                            <select class="form-control custom-select" id="category" name="category" required>
                                <option value="1" <?= $row['category'] == '1' ? 'selected' : '' ?>>Món chính</option>
                                <option value="2" <?= $row['category'] == '2' ? 'selected' : '' ?>>Món phụ</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($row['description']) ?></textarea>
                        </div>
                        <div class="form-group mt-3">
                            <label for="image_url">Ảnh</label>
                            <input type="text" class="form-control" id="image_url" name="image_url" value="<?= htmlspecialchars($row['image_url']) ?>" required>
                        </div>
                        <div class="form-group mt-3">
                            <label for="status">Trạng thái</label>
                            <select class="form-control custom-select" id="status" name="status" required>
                                <option value="available" <?= $row['status'] == 'available' ? 'selected' : '' ?>>Còn hàng</option>
                                <option value="soldout" <?= $row['status'] == 'soldout' ? 'selected' : '' ?>>Hết hàng</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="created_at">Ngày tạo</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" value="<?= htmlspecialchars($row['created_at']) ?>" disabled>
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

