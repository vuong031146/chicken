<?php
require_once 'config.php';
require_once 'layouts/header.php';
?>

        <div class="background-img">
            <div class="grid">
            </div>
        </div>
        <div class="content">
            <div class="grid wide">
                <div class="food-sale">
                <div class="dssp vcenter vfontlale vline">
                                <h2>DANH SÁCH SẢN PHẨM</h2>
                            </div>
                    <ul class="sale-list row sm-gutter">
                        <?php
                        $sql = "SELECT * FROM products";
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
                
                <div class="row sm-gutter story">
                    <div class="col img-story c-12 m-12 l-6">
                        
                        <div class="list-img-story">
                            <img src="<?= $system['logo'] ?>" alt="" class="image-story">
                        </div>
                    </div>
                    <div class="col story-head c-12 m-12 l-6">
                        <h3 class="story-name">VỀ CHÚNG TÔI</h3>
                        <h2 class="name-store"><?= $system['name'] ?></h2>
                        <p class="story-text"><?= $system['name'] ?> là thương hiệu gà rán đến từ Việt Nam. Thực đơn được trực tiếp phát triển bởi đội ngũ chuyên gia người Việt Nam với kinh nghiệm nghiên cứu hơn 5 năm. Cùng với các nhà nghiên cứu của tập đoàn NBT tập đoàn hàng đầu về thực phẩm. Với mục tiêu mang đến cho thực khách những món ăn vừa miệng và đảm bảo chất lượng.</p>
                        <p class="story-text-1">Thương hiệu gà rán <?= $system['name'] ?> cam kết chỉ sử dụng những nguyên liệu gà tươi ngon, chất lượng nhất, không sử dụng thực phẩm đông lạnh. Các món ăn sẽ được chế biến hàng ngày và đảm bảo nóng hổi, giòn ngon khi đem ra bàn phục vụ thực khách.</p>
                    </div>
                </div>

                <div class="reason">
                    
                    <h4 class="first-reason">TẠI SAO NÊN ĐẾN VỚI <span class="reason-name "><?= $system['name'] ?></span></h4>
                    <ul class="row sm-gutter list-reason">
                        <li class="item-reason l-4 m-12 c-12">
                            <img src="https://file.hstatic.net/200000585055/file/cach-nhan-biet-thit-ga-hong-the-gioi-thit-3a_-min_76e6c249a7bb4d72bab28b0410d8a0e5_grande.jpeg" alt="" class="reason-img">
                            <h3 class="sub-reason">NGUYÊN LIỆU CHẤT LƯỢNG</h3>
                            <p class="text-reason">Chúng tôi sử dụng nguồn gà chất lượng cao, tươi ngon, không sử dụng thực phẩm đông lạnh.</p>
                        </li>
                        <li class="item-reason l-4 m-12 c-12">
                            <img src="https://www.cukcuk.vn/wp-content/uploads/2023/02/Sinry-Bulgogi-2.jpg" alt="" class="reason-img">
                            <h3 class="sub-reason">SẢN PHẨM ĐA DẠNG</h3>
                            <p class="text-reason">Chúng tôi phục vụ đầy đủ các loại sản phẩm từ gà rán, đồ uống, đồ ăn nhanh, đồ ăn vặt, đồ uống...</p>
                        </li>
                        <li class="item-reason l-4 m-12 c-12">
                            <img src="https://cdn.tgdd.vn/2021/10/CookDish/8-cach-pha-sot-cham-thit-nuong-thom-ngon-avt-1200x676.jpg" alt="" class="reason-img">
                            <h3 class="sub-reason">SỐT GIA TRUYỀN</h3>
                            <p class="text-reason">Chúng tôi sử dụng sốt bí mật đặc biệt, không chỉ vậy mà còn phù hợp nhiều lứa tuổi</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
<?php
require_once 'layouts/footer.php';
?>
</body>
</html>