<?php
require_once 'config.php';
require_once 'layouts/header.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `products` WHERE `id` = '{$id}'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    die("Lỗi truy vấn: " . mysqli_error($conn));
}
$data = mysqli_fetch_assoc($result);
if(isset($_POST['add_to_cart'])){
    $query = mysqli_query($conn, "SELECT * FROM `customers` WHERE `username` = '{$_SESSION['username']}'");
    $acc = mysqli_fetch_assoc($query);
    if(isset($_SESSION['username'])){
    $quantity = $_POST['quantity'];
    $product_id = $id;
    $customer_id = $acc['id'];
    $query = "INSERT INTO `cart` (`product_id`, `quantity`, `customer_id`, `created_at`) VALUES ('$product_id', '$quantity', '$customer_id', NOW())";
    mysqli_query($conn, $query);
    echo "<script>Swal.fire('Thông báo','Thêm vào giỏ hàng thành công','success'); setTimeout(function(){window.location.href = '/';}, 1000);</script>";
    }else{
        echo "<script>Swal.fire('Thông báo','Vui lòng đăng nhập để thêm vào giỏ hàng','warning');</script>";
        echo "<script>setTimeout(function(){window.location.href = '/auth/login.php';}, 1000);</script>";
        exit();
    }   
}


?>
        <div class="content content-background-color margin-top" style="padding-bottom: 30px;">
            <div class="grid wide">
                <div class="row sm-gutter product-detail">
                    <div class="col l-6 m-12 c-12">
                        <img src="<?= $data['image_url'] ?>" alt="" class="product-img product-img-height">
                    </div>
                    <div class="col l-6 m-12 c-12">
                        <div class="product-detail-info">
                            <h2 class="product-detail-name"><?= $data['name'] ?></h2>
                            <p class="product-detail-type"><?php if($data['category'] == 1){echo 'Món chính';}else{echo 'Món phụ';} ?></p>
                            <p class="product-detail-text"><?= $data['description'] ?></p>
                            <div>
                                <div>
                                    <i class="product-detail-icon fa-solid fa-money-bill-1-wave"></i>
                                    <p class="product-detail-price"><?= number_format($data['price']) ?>₫</p>
                                </div>
                                <div>
                                    <i class="product-detail-icon fa-solid fa-users-line"></i>
                                    <p class="product-detail-amount"></p>
                                </div>
                            </div>
                            <form action="#" method="post">
    <div>
        <div class="quantity">
            <p class="">Số lượng: </p>
            <div class="select-amount" style="display: flex; align-items: center; gap: 5px;">
                <button type="button" class="qty-btn" onclick="thaydoiSoLuong(-1)">-</button>
                <input type="text" id="quantity" name="quantity" value="1" min="1" inputmode="numeric" pattern="[0-9]*" style="width: 50px; text-align: center;">
                <button type="button" class="qty-btn" onclick="thaydoiSoLuong(1)">+</button>
            </div>
        </div>
        <button class="product-detail-btn" name="add_to_cart" type="submit">Thêm vào giỏ hàng</button>
    </div>
</form>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <script>
    function thaydoiSoLuong(change) {
        const input = document.getElementById("quantity");
        let hientai = parseInt(input.value) || 1;
        hientai += change;
        if (hientai < 1) hientai = 1;
        input.value = hientai;
    }
</script>
<?php include_once 'layouts/footer.php'; ?>