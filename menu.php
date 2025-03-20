<?php
require_once 'config.php';
require_once 'layouts/header.php';
$category = $_GET['category'];

?>

<div class="content content-background-color margin-top" style="padding-bottom: 30px;">
            <div class="grid wide">
                <h3 class="more-product more-product--unhover">
                    <span class="line"></span>
                    <?= $category == '1' ? 'Món chính' : 'Món phụ' ?>
                </h3>
                <ul class="row sm-gutter main-course-list">
                <?php
                        $sql = "SELECT * FROM products WHERE category = '{$category}'";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <li class="col product l-4 m-6 c-12 border-sale">
                            <a href="./DetaiProduct.html" class="product-link">
                                <img src="<?= $row['image_url'] ?>" alt="" class="product-img margin-bottom-44">
                                <h3 class="product-name"><?= $row['name'] ?></h3>
                                <h4 class="product-type"><?= $row['category'] == '1' ? 'Món chính' : 'Món phụ' ?></h4>
                                <div class="product-info">
                                    <h3 class="product-price"><?= number_format($row['price']) ?>₫</h3>
                                </div>
                                <div class="button-add-cart">
                                   <a href="DetaiProduct.php?id=<?= $row['id'] ?>"> <button class="btn-add-cart"> <i class="fa-solid fa-cart-shopping"></i> Thêm vào giỏ hàng</button></a>
                                </div>
                            </a>
                        </li>
                        <?php
                        }
                        ?>
                    
                </ul>
            </div>
        </div>
<?php include_once 'layouts/footer.php'; ?>