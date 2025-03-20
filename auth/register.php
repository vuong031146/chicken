<?php
require_once '../config.php';
if(isset($_SESSION['username'])){
    header('location: /');
    exit();
}
if(isset($_POST['register'])){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $sql = "SELECT * FROM `customers` WHERE `username`  = '{$username}'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    if(!$data['username']){
        $query = "INSERT INTO `customers` (`username`, `password`, `name`, `email`, `phone`, `created_at`,`address`, `role`) VALUES ('{$username}', '{$password}', '{$fullname}', '{$email}', '{$phone}', NOW(), 'Trống', '0')";
        mysqli_query($conn, $query);
        $status = true;
        $msg = "Đăng ký thành công";
        $_SESSION['username'] = $username;
    }else{
        $status = false;
        $msg = "Tên đăng nhập đã tồn tại";  
    }
}
require_once '../layouts/header.php';
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
                    window.location.href = '/';
                }, 2000);
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
<div class="container">
        <div class="login-form">
        <h2 class="form-title">Đăng ký</h2>
        <span class="title-underline"></span>
        <form action="#" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Tên đăng nhập</label>
                        <input type="text" class="input-login" placeholder="Tên đăng nhập" name="username" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Họ tên</label>
                        <input type="text" class="input-login" placeholder="Họ tên" name="fullname" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" class="input-login" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="input-login" placeholder="Số điện thoại" name="phone" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Mật khẩu</label>
            <input type="password" class="input-login" placeholder="Mật khẩu" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn-login" name="register">Đăng ký</button>
        </div>
        <div class="form-group mt-2 text-center">
            <span class="">Bạn đã có tài khoản? <a href="/auth/login.php" class="register-link">Đăng nhập</a></span>
        </div>
        </form>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>