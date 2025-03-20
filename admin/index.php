<?php
require_once '../config.php';
if(empty($_SESSION['username']) || $account['role'] != 1){
    header('Location: /auth/login.php');
    exit();
}
require_once 'header.php';


if(isset($_POST['add_customer'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $sql = "INSERT INTO customers (name, phone, email, address, username, password, role) VALUES ('{$name}', '{$phone}', '{$email}', '{$address}', '{$username}', '{$password}', '{$role}')";
    mysqli_query($conn, $sql);
    $status = true;
    $msg = "Thêm khách hàng thành công";
}
if(isset($_POST['add_order'])){
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $sql = "SELECT * FROM products WHERE id = '{$product_id}'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price = $row['price'];
    $total_price = $price * $quantity;
    if($product_id == '' || $quantity == ''){
        $status = false;
        $msg = "Vui lòng nhập đầy đủ thông tin";
    }else if($total_price == 0){
        $status = false;
        $msg = "Tổng tiền không được bằng 0";
    }else if($row['status'] == 'soldout'){
        $status = false;
        $msg = "Sản phẩm đã hết hàng";
    }else{
        if($customer_id == ''){
            $KH = '0';
        } else {
            $KH = $customer_id;
        }
        $sql = "INSERT INTO orders (`customer_id`, `product_id`, `quantity`, `total_price`, `status`) VALUES ('{$KH}', '{$product_id}', '{$quantity}', '{$total_price}', 'pending')";
        mysqli_query($conn, $sql);
        $status = true;
        $msg = "Thêm đơn hàng thành công";
    }
}
if(isset($_POST['add_product'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $sql = "INSERT INTO products (name, price, status, category, image_url, description, created_at) VALUES ('{$name}', '{$price}', '{$status}', '{$category}', '{$image_url}', '{$description}', NOW())";
    mysqli_query($conn, $sql);
    $status = true;
    $msg = "Thêm sản phẩm thành công";
}
if(isset($_POST['add_system'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $domain = mysqli_real_escape_string($conn, $_POST['domain']);
    $logo = mysqli_real_escape_string($conn, $_POST['logo']);
    $keyword = mysqli_real_escape_string($conn, $_POST['keyword']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $sql = "UPDATE system SET name = '{$name}', title = '{$title}', domain = '{$domain}', logo = '{$logo}', keyword = '{$keyword}', phone = '{$phone}', email = '{$email}', address = '{$address}' WHERE id = 1";
    mysqli_query($conn, $sql);
    $status = true;
    $msg = "Chỉnh sửa hệ thống thành công";
}
if($msg) {
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
                }, 1500);
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
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#system" class="list-group-item list-group-item-action active" data-bs-toggle="tab">Quản lý hệ thống</a>
                    <a href="#orders" class="list-group-item list-group-item-action" data-bs-toggle="tab">Quản lý đơn hàng</a>
                    <a href="#inventory" class="list-group-item list-group-item-action" data-bs-toggle="tab">Quản lý sản phẩm</a>
                    <a href="#customers" class="list-group-item list-group-item-action" data-bs-toggle="tab">Quản lý khách hàng</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                <div class="tab-pane fade show active" id="system">
    <h3>Quản lý hệ thống <i class="fa-solid fa-gear fa-spin"></i></h3>
    <div class="card mt-3">
        <div class="card-header">Chỉnh sửa thông tin hệ thống</div>
        <div class="card-body">
            <form action="index.php" method="post">
                <div class="row">
                    <!-- Cột bên trái -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tên hệ thống</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $system['name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Tiêu đề hệ thống</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $system['title'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="domain">Tên miền</label>
                            <input type="text" class="form-control" id="domain" name="domain" value="<?= $system['domain'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="keyword">Từ khóa SEO</label>
                            <input type="text" class="form-control" id="keyword" name="keyword" value="<?= $system['keyword'] ?>" required>
                        </div>
                        
                    </div>

                    <!-- Cột bên phải -->
                    <div class="col-md-6">
                        
                        <div class="form-group">
                            <label for="logo">Link ảnh Logo</label>
                            <input type="text" class="form-control" id="logo" name="logo" value="<?= $system['logo'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại liên hệ</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?= $system['phone'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email liên hệ</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $system['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control custom-select" id="status" name="status" required>
                                <option value="<?= $system['status'] == 'on' ? 'selected' : '' ?>">Hoạt động</option>
                                <option value="<?= $system['status'] == 'off' ? 'selected' : '' ?>">Không hoạt động</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="address">Địa chỉ</label>
                    <textarea class="form-control" id="address" name="address" required><?= $system['address'] ?></textarea>
                </div>

                <div class="form-group mt-3 text-center">
                    <button type="submit" name="add_system" class="btn btn-dark">
                        <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>  
</div>

                    <div class="tab-pane fade show" id="orders">
                        <h3>Đơn hàng <i class="fa-solid fa-cart-shopping"></i><button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addOrderModal"><i class="fa-solid fa-plus"></i> Thêm đơn hàng</button></h3>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                    <th>Mã đơn</th>
                                    <th>Khách hàng</th>
                                    <th>Sản phẩm</th>
                                    <th>Tổng tiền</th>
                                    <th>Số lượng</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr> 
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM orders";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $product_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `products` WHERE `id` = $row[product_id]"));
                                    $customer_id = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `customers` WHERE `id` = $row[customer_id]"));
                                ?>
                                <tr>
                                    <td><span class="badge bg-primary">#<?= $row['id'] ?></span></td>
                                    <td><?php if($customer_id['name'] == '0' || $customer_id['name'] == '') {
                                        echo 'Khách';
                                    } else {
                                        echo $customer_id['name'];
                                    } ?></td>
                                    <td><?= $product_id['name'] ?></td>
                                    <td><?= number_format($row['total_price']) ?> VNĐ</td>
                                    <td><span class="badge bg-dark"><?= $row['quantity'] ?></span></td>
                                    <td><span class="badge bg-<?= $row['status'] == 'pending' ? 'warning' : ($row['status'] == 'processing' ? 'info' : ($row['status'] == 'completed' ? 'success' : 'danger')) ?>">
                                            <?= $row['status'] == 'pending' ? 'Chờ xác nhận' : ($row['status'] == 'processing' ? 'Đang xử lý' : ($row['status'] == 'completed' ? 'Đã hoàn thành' : 'Đã hủy')) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin/edit_orders.php?edit=<?= $row['id'] ?>">Sửa</a>
                                        <a class="btn btn-danger" href="/admin/edit_orders.php?delete=<?= $row['id'] ?>">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="inventory">
                        <h3>Sản phẩm <i class="fa-solid fa-box-open"></i><button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addProductModal"><i class="fa-solid fa-plus"></i> Thêm sản phẩm</button></h3>
                        <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                
                                <tr>
                                    
                                    <th>Mã sản phẩm</th>
                                    <th>Ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $sql = "SELECT * FROM products";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><span class="badge bg-primary">#<?php echo $row['id']; ?></span></td>
                                    <td><img src="<?= $row['image_url'] ?>" alt="" style="width: 100px; height: 100px;"></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= number_format($row['price']) ?> VNĐ</td>
                                    <td><span class="badge bg-<?= $row['category'] == '1' ? 'secondary' : 'info' ?>"><?= $row['category'] == '1' ? 'Món chính' : 'Món phụ' ?></span></td>
                                    <td><textarea name="" id="" cols="30" rows="4"><?= $row['description'] ?></textarea></td>
                                    <td><span class="badge bg-<?= $row['status'] == 'available' ? 'success' : 'danger' ?>"><?= $row['status'] == 'available' ? 'Còn hàng' : 'Hết hàng' ?></span></td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin/edit_product.php?edit=<?= $row['id'] ?>">Sửa</a>
                                        <a class="btn btn-danger" href="/admin/edit_product.php?delete=<?= $row['id'] ?>">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="customers">
                        <h3>Khách hàng <i class="fa-solid fa-user-group"></i><button class="btn btn-warning btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addCustomerModal"><i class="fa-solid fa-plus"></i> Thêm khách hàng</button></h3>
                            <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Mã khách hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Mật khẩu</th>
                                    <th>Quyền</th>
                                    <th>Số điện thoại</th>
                                    <th>Email</th>
                                    <th>Địa chỉ</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM customers";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <tr>
                                    <td><span class="badge bg-primary">#<?= $row['id'] ?></span></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= $row['password'] ?></td>
                                    <td><span class="badge bg-<?= $row['role'] == '1' ? 'success' : 'info' ?>"><?= $row['role'] == '1' ? 'Admin' : 'Khách hàng' ?></span></td>
                                    <td><?= $row['phone'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td><textarea name="" id="" cols="30" rows="4"><?= $row['address'] ?></textarea></td>
                                    <td>
                                        <a class="btn btn-primary" href="/admin/edit_customer.php?edit=<?= $row['id'] ?>">Sửa</a>
                                        <a class="btn btn-danger" href="/admin/edit_customer.php?delete=<?= $row['id'] ?>">Xóa</a>
                                    </td>
                                </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade"  id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ffc107;">
                        <h5 class="modal-title text-white" id="addCustomerModalLabel">Thêm khách hàng</h5>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Tên đăng nhập</label>
                                <input type="text" class="form-control" placeholder="Nhập tên đăng nhập" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mật khẩu</label>
                                <input type="password" class="form-control" placeholder="Nhập mật khẩu" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Quyền</label>
                                <select class="form-control custom-select" id="role" name="role" required>
                                    <option value="1">Admin</option>
                                    <option value="0">Khách hàng</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên khách hàng</label>
                                <input type="text" class="form-control" placeholder="Nhập tên khách hàng" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="number" class="form-control" placeholder="Nhập số điện thoại" id="phone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Nhập email" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" placeholder="Nhập địa chỉ" id="address" name="address" required></textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> &nbsp;
                                <button type="submit" name="add_customer" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal add order -->
        <div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="addOrderModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ffc107;">
                        <h5 class="modal-title text-white" id="addOrderModalLabel">Thêm đơn hàng</h5>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="post">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Khách hàng</label>
                                <select class="form-control custom-select" id="customer_id" name="customer_id">
                                    <option value="">Chọn khách hàng (Để trống nếu khách hàng mới)</option>
                                    <?php
                                    $sql = "SELECT * FROM customers";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>  
                            <div class="mb-3">
                                <label for="product_id" class="form-label">Sản phẩm</label>
                                <select class="form-control custom-select" id="product_id" name="product_id" required>
                                    <option value="">Chọn sản phẩm</option>
                                    <?php
                                    $sql = "SELECT * FROM products";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input type="number" class="form-control" placeholder="Nhập số lượng" id="quantity" name="quantity" required>
                            </div>
                            
                            <div class="form-group d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> &nbsp;
                                <button type="submit" name="add_order" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #ffc107;">
                        <h5 class="modal-title text-white" id="addProductModalLabel">Thêm sản phẩm</h5>
                    </div>  
                    <div class="modal-body">
                        <form action="index.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control" placeholder="Nhập giá" id="price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Ảnh</label>
                                <input type="text" class="form-control" placeholder="Nhập link ảnh" id="image_url" name="image_url" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea class="form-control" placeholder="Nhập mô tả" id="description" name="description" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Danh mục</label>
                                <select class="form-control custom-select" id="category" name="category" required>
                                    <option value="1">Món chính</option>
                                    <option value="2">Món phụ</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-control custom-select" id="status" name="status" required>
                                    <option value="available">Còn hàng</option>
                                    <option value="soldout">Hết hàng</option>
                                </select>
                            </div>
                            <div class="form-group d-flex justify-content-end mt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button> &nbsp;
                                <button type="submit" name="add_product" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Thêm</button>
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
