<?php
require_once '../config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $case_code = random_int(100000, 999999);
    $subject = 'THU YEU CAU HO TRO CASE #'.$case_code;
    
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
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
        $mail->Subject = $subject;
        $mail->Body = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Submission</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
        }
        .email-header {
            background-color: #4a90e2;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            color: white;
            margin: 0;
            font-size: 24px;
        }
        .email-content {
            padding: 20px;
            background-color: white;
        }
        .email-info {
            margin-bottom: 20px;
            border-bottom: 1px solid #eeeeee;
            padding-bottom: 20px;
        }
        .email-info p {
            margin: 5px 0;
        }
        .email-info strong {
            color: #4a90e2;
        }
        .email-message {
            background-color: #f5f5f5;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .email-message p {
            margin: 0 0 10px 0;
        }
        .email-footer {
            padding: 15px;
            text-align: center;
            font-size: 12px;
            color: #666666;
            background-color: #f1f1f1;
        }
        .timestamp {
            text-align: right;
            font-size: 12px;
            color: #888888;
            margin-bottom: 15px;
        }
        @media only screen and (max-width: 600px) {
            .email-header h1 {
                font-size: 20px;
            }
            .email-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Yêu Cầu Hỗ Trợ #'.$case_code.'</h1>
        </div>
        <div class="email-content">
            <div class="timestamp">
                Ngày: ' . date("d/m/Y") . ' - ' . date("H:i:s") . '
            </div>
            <div class="email-info">
                <p><strong>Họ tên:</strong> ' . $name . '</p>
                <p><strong>Email:</strong> <a href="mailto:' . $email . '">' . $email . '</a></p>
            </div>
            <div class="email-message">
                <h3>Nội dung tin nhắn:</h3>
                <p>' . nl2br($message) . '</p>
            </div>
        </div>
        <div class="email-footer">
            <p>Email này được gửi tự động từ hệ thống liên hệ website.</p>
            <p>&copy; ' . date("Y") . ' '.$system['name'].' All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>
        ';
        
        $mail->send();
        $status = true;
        $msg = "Gửi liên hệ thành công";
    } catch (Exception $e) {
        $status = false;
        $msg = "Gửi liên hệ thất bại";
    }
}
echo json_encode(['status' => $status, 'msg' => $msg]);
?>