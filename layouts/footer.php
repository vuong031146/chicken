
<div class="hotline-phone-ring-wrap">
    <div class="hotline-phone-ring">
        <div class="hotline-phone-ring-circle"></div>
        <div class="hotline-phone-ring-circle-fill"></div>
        <div class="hotline-phone-ring-img-circle">
            <a href="tel:<?= $system['phone'] ?>" class="pps-btn-img"> <img src="https://nguyenvandinh.com/Content/template/ANThanhs/images/icon-call-nh.png" alt="Gọi điện thoại" width="70"> </a>
        </div>
    </div>
    <!-- <div class="hotline-bar"> <a href="tel:<?= $system['phone'] ?>"><span class="text-hotline">Call Now</span></a> </div> -->
</div>

        <div class="footer">
            <div class="grid wide">
                <div class="footer-content row">
                    <div class="col div-item l-3 m-6 c-12">
                        <h3 class="footer-header"><?= $system['name'] ?></h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <i class="footer-icon fa-solid fa-location-dot"></i>
                                <p class="footer-addres"><?= $system['address'] ?></p>
                            </li>
                            <li class="footer-item">
                                <i class="footer-icon fa-solid fa-phone-volume"></i>
                                <p class="footer-addres"><?= $system['phone'] ?></p>
                            </li>
                            <li class="footer-item">
                                <i class="footer-icon fa-solid fa-envelope"></i>
                                <p class="footer-addres"><?= $system['email'] ?></p>
                            </li>
                            <li class="footer-item">
                                <i class="footer-icon fa-solid fa-globe"></i>
                                <p class="footer-addres">www.<?= $system['domain'] ?></p>
                            </li>
                        </ul>
                    </div>

                    

                    <div class="col div-item l-3 m-6 c-12">
                        <h3 class="footer-header">Thông Tin</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <a href="/menu.php?category=1" class="footer-item-link">Món chính</a>
                            </li>
                            <li class="footer-item">
                                <a href="/menu.php?category=2" class="footer-item-link">Món phụ</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item-link">Tuyển Dụng</a>
                            </li>
                            <li class="footer-item">
                                <a href="#" class="footer-item-link">Chính Sách</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col div-item l-3 m-6 c-12">
                        <h3 class="footer-header">Thanh Toán</h3>
                        <ul class="footer-list footer-list-pay">
                            <li class="footer-item">
                                <img src="/assest/img/vnp.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/momo.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/mastercard.jpg" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/visa.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/shoppePay.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/bevu.jpg" alt="" class="img-footer">
                            </li>
                        </ul>
                        <h3 class="footer-header">Đơn Vị Vận CHuyển</h3>
                        <ul class="footer-list footer-list-delivery">
                            <li class="footer-item">
                                <img src="/assest/img/grab.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/gojeck.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/baemin.png" alt="" class="img-footer">
                            </li>
                            <li class="footer-item">
                                <img src="/assest/img/be.png" alt="" class="img-footer">
                            </li>
                        </ul>
                    </div>

                    <div class="col div-item l-3 m-6 c-12">
                        <h3 class="footer-header">Theo Dõi Chúng Tôi <br>Trên</h3>
                        <ul class="footer-list">
                            <li class="footer-item">
                                <i class="footer-icon fa-brands fa-facebook"></i>
                                <p class="footer-contact">Facebook</p>
                            </li>
                            <li class="footer-item">
                                <i class="footer-icon fa-brands fa-instagram"></i>
                                <p class="footer-contact">Instagram</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assest/main.js?v=1.0.2"></script>    
        <script src="/assest/custom.js?v=<?= time() ?>"></script>
    </div>