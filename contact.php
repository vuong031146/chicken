<?php
require_once 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nam25091100@gmail.com';
        $mail->Password = 'ibvxukgraaqixczz';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('nam25091100@gmail.com', 'SYSTEM');
        $mail->addAddress('ngodinhnam.dev@gmail.com', 'SYSTEM');

        $mail->isHTML(true);
        $mail->Subject = 'THU YEU CAU HO TRO';
        $mail->Body = "Name: " . $name . "<br>Email: " . $email . "<br>Message: " . nl2br($message);
        
        $mail->send();
        $status = true;
        $msg = "Gửi liên hệ thành công";
    } catch (Exception $e) {
        $status = false;
        $msg = "Gửi liên hệ thất bại";
    }
}

require_once 'layouts/header.php';
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
                window.location.href = '/contact.php';
            }, 1000);
        <?php }else{ ?>
            Swal.fire({
                title: 'Thông báo',
                text: '<?= $msg; ?>',
                icon: 'error'
            });
        <?php } ?>
    </script>
<?php } ?>
<div class="content">
            <div alt="" class="grid img-contact"></div> 
            <div class="modal-background">
                <div class="grid wide">
                    <div class="modal-container">
                        <h2 class="modal-header">GỬI LIÊN HỆ QUA EMAIL</h2>
                        <form action="#" method="POST">    
                            <div class="row sm-gutter">
                                <div class="col l-o-2 l-4 m-12 c-12">
                                    <input type="text" required placeholder="Tên" class="modal-input " name="name">
                                </div>
                                <div class="col l-4 m-12 c-12">
                                    <input type="text" required placeholder="Email" class="modal-input " name="email">
                                </div>
                                <div class="col l-o-2 l-8 m-12 c-12">
                                    <textarea type="text" required placeholder="Nội dung" rows="5" class="modal-input " name="message"></textarea>
                                </div>
                                </div>
                            <button class="modal-send" name="send" type="submit" >Gửi</button>
                        </form>
                    </div> 
                </div>
            </div>
        </div>

