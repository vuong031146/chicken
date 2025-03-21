<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $system['title'] ?></title>
    <meta name="description" content="<?= $system['keyword'] ?>">
    <meta name="keywords" content="<?= $system['keyword'] ?>">
    <link rel="stylesheet" href="/assest/css/base.css?=<?= time(); ?>">
    <link rel="stylesheet" href="/assest/css/grid.css?=<?= time(); ?>">
    <link rel="stylesheet" href="/assest/css/style.css?=<?= time(); ?>">
    <link rel="stylesheet" href="/assest/css/reponsive.css?=<?= time(); ?>">
    <link rel="stylesheet" href="/assest/css/custom.css?=<?= time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.1/dist/sweetalert2.min.js"></script>
<style>
    
</style>
</head>
<body>
    <div class="wrapper">
        <header class="header">
            <div class="grid wide">
                <div class="navigation">
                    <div class="name-store-tablet-mobile">
                        <?= $system['name'] ?>
                    </div>
                    <a href="/">
                        <img src="<?= $system['logo'] ?>" alt=""class="header-logo">
                    </a>
                    <ul class="navigation-left">
                        <li class="navigation-item">
                            <a href="/" class="navigation-link navigation-link--active">
                                TRANG CHỦ
                            </a>
                        </li>
                        <li class="navigation-item navigation-item--has-menu">
                            <a href="" class="navigation-link ">
                                DANH MỤC
                            </a>
                            <!-- header menu  -->
                            <div class="header-menu">
                                <ul class="header-menu-list">
                                    <li class="menu-item">
                                        <a href="/menu.php?category=1" class="menu-item-link">
                                            MÓN CHÍNH
                                        </a>
                                    </li>
                                    <span></span>
                                    <li class="menu-item">
                                        <a href="/menu.php?category=2" class="menu-item-link">
                                            MÓN PHỤ
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="icon-timkiem">
        <i class="fa-solid fa-magnifying-glass fa-lg text-white"></i>
        <input type="text" placeholder="Tìm kiếm" class="search-input">
</li>

                    </ul>
                    
                    <ul class="navigation-right">
                    
                    <li class="navigation-item">
                            <a href="/contact.php" class="navigation-link">
                                LIÊN HỆ
                            </a>
                        </li>
                        <?php if(isset($_SESSION['username'])){ ?>
                        <li class="navigation-item">
                            <a href="/auth/logout.php" class="navigation-link">
                                ĐĂNG XUẤT
                            </a>
                        </li>
                        <?php }else{ ?>
                        <li class="navigation-item">
                            <a href="/auth/login.php" class="navigation-link">
                                ĐĂNG NHẬP
                            </a>
                        </li>
                        <?php } ?>
                        <li class="navigation-item">
                            <ul class="navigation-icon">
                                
                            <li class="icon-bag">
    <?php 
    if (empty($_SESSION['username'])) { 
    ?>
        <a href="#" onclick="Swal.fire({
            title: 'Thông báo',
            text: 'Bạn cần đăng nhập để xem giỏ hàng',
            icon: 'warning'
        });
        setTimeout(function(){
            window.location.href = '/auth/login.php';
        }, 2000);">
            <i class="icon-header-shoping icon-shoping-js fa-solid fa-bag-shopping"></i>
        </a>
    <?php 
    } else { 
        $acc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `customers` WHERE `username` = '{$_SESSION['username']}'"));
        $user_id = $acc['id'];  
        $sql = "SELECT COUNT(*) as cart_count FROM `cart` WHERE `customer_id` = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $cart_count = $row['cart_count'];

        if ($cart_count > 0) {
            echo '<a href="/cart.php">';
            echo '<i class="icon-header-shoping icon-shoping-js fa-solid fa-bag-shopping"></i>';
            echo '<span class="badge">' . $cart_count . '</span>';
            echo '</a>';
        } else {
            echo '<a href="/cart.php">';
            echo '<i class="icon-header-shoping icon-shoping-js fa-solid fa-bag-shopping"></i>';
            echo '</a>';
        }
    } 
    ?>
</li>
                             <li class="icon-bar">
                                    <i class="icon-header icon-header-bar fa-solid fa-bars"></i>
                                    <div class="navigation-container navigation-container-js">
                                        <div class="navigation-mobile">
                                            <div class="header-navigation-mobile">
                                                <div>
                                                    <img src="<?= $system['logo'] ?>" alt="" class="logo-mobile">
                                                    <p class="">
                                                        <?= $system['name'] ?>
                                                    </p>
                                                </div>
                                                <i class="mobile-icon-close fa-solid fa-x"></i>
                                            </div>
                                            <ul class="list-mobile">
                                                <li class="mobile-item">
                                                    <a href="/" class="mobile-item-link mobile-item-link-active">
                                                        TRANG CHỦ 
                                                    </a>
                                                </li>
                                                <li class="mobile-item">
                                                    <a href="/menu.php?category=1" class="mobile-item-link">
                                                        MÓN CHÍNH
                                                    </a>
                                                </li>
                                                <li class="mobile-item">
                                                    <a href="/menu.php?category=2" class="mobile-item-link">
                                                        MÓN PHỤ
                                                    </a>
                                                </li>
                                                <li class="mobile-item">
                                                    <a href="/contact.php" class="mobile-item-link">
                                                        LIÊN HỆ
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </header>