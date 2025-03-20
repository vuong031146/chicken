<?php
require_once '../config.php';
if(isset($_SESSION['username'])){
    header('location: /');
    exit();
}
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM customers WHERE username = '{$username}'";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    if($data['id'] && $password == $data['password']){
        $status = true;
        $msg = "Đăng nhập thành công";
        $_SESSION['username'] = $data['username'];
    }else{
        $status = false;
        $msg = "Tên đăng nhập hoặc mật khẩu không chính xác";
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
        <h2 class="form-title">Đăng nhập</h2>
        <span class="title-underline"></span>
        <form action="#" method="post">
        <div class="form-group">
            <label class="form-label">Tên đăng nhập</label>
            <input type="text" class="input-login" placeholder="Tên đăng nhập" name="username" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Mật khẩu</label>
            <input type="password" class="input-login" placeholder="Mật khẩu" name="password" required>
        </div>
        <div class="form-group">
            <button class="btn-login" name="login">Đăng nhập</button>
        </div>
        <div class="form-group mt-2 text-center">
            <span class="">Bạn chưa có tài khoản? <a href="/auth/register.php" class="register-link">Đăng ký ngay</a></span>
        </div>
        </form>
    </div>
</div>

<?php require_once '../layouts/footer.php'; ?>