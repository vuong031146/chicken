<?php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biểu mẫu liên hệ | <?= $system['title'] ?></title>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .contact-form {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }

        .form-header {
            margin-bottom: 24px;
        }

        .form-header h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 0 2px rgba(74, 144, 226, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .submit-btn {
            background-color: #4a90e2;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #3a7bc8;
        }

        .submit-btn:disabled {
            background-color: #a0c0e8;
            cursor: not-allowed;
        }

        /* Error styling */
        .error {
            color: #e74c3c;
            font-size: 12px;
            margin-top: 4px;
            display: none;
        }

        .form-control.invalid {
            border-color: #e74c3c;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .contact-form {
                padding: 20px;
            }
        }
        /* Back to home button */
        .back-home {
            display: inline-flex;
            align-items: center;
            background-color: #f1f1f1;
            color: #333;
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-bottom: 20px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .back-home:hover {
            background-color: #e0e0e0;
        }

        .back-home i {
            margin-right: 8px;
        }

        /* Form actions */
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form-actions .back-home {
            margin-bottom: 0;
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .contact-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="contact-form">
        <div class="form-header">
            <h2>Liên hệ với <span style="color: #f8b02d;"><?= $system['name'] ?></span></h2>
            <p>Điền vào mẫu dưới đây và chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể.</p>
        </div>
            <div class="form-group">
                <label for="name">Họ tên</label>
                <input type="text" id="name" class="form-control" placeholder="Nhập họ tên của bạn">
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" class="form-control" placeholder="example@gmail.com">
            </div>
            
            <div class="form-group">
                <label for="message">Nội dung</label>
                <textarea id="message" rows="4" class="form-control" placeholder="Nhập nội dung liên hệ"></textarea>
            </div>
            <div class="form-actions">
            <a href="/" class="back-home">
                    <i class="fas fa-arrow-left"></i> Quay lại
            </a>
                <button type="submit" class="submit-btn" id="contactForm">
                    <i class="fas fa-paper-plane"></i> Gửi liên hệ
                </button>

            </div>
    </div>
    
    <script>
        $(document).ready(function() {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: 5000
    };

    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    $("#contactForm").click(function(e) {
        e.preventDefault();
        let name = $("#name").val().trim();
        let email = $("#email").val().trim();
        let message = $("#message").val().trim();
        let submitBtn = $("#contactForm");

        if (!name) {
            toastr.warning('Vui lòng nhập họ tên', 'Lỗi!');
            return;
        }
        if (!email) {
            toastr.warning('Vui lòng nhập email', 'Lỗi!');
            return;
        } else if (!isValidEmail(email)) {
            toastr.warning('Email không hợp lệ', 'Lỗi!');
            return;
        }
        if (!message) {
            toastr.warning('Vui lòng nhập nội dung', 'Lỗi!');
            return;
        }

        submitBtn.prop('disabled', true);
        submitBtn.text('Đang gửi...');

        $.ajax({
            url: '/post/send-mail.php',
            type: 'POST',
            data: {name: name, email: email, message: message},
            dataType: 'json',
            success: function(res) {
                if (res.status) {
                    toastr.success(res.msg || 'Gửi liên hệ thành công!', 'Thành công!');
                    $("#contactForm")[0].reset();
                } else {
                    toastr.error(res.msg || 'Gửi liên hệ thất bại. Vui lòng thử lại.', 'Lỗi!');
                }
            },
            error: function(xhr, status, error) {
                toastr.error('Có lỗi xảy ra. Vui lòng thử lại sau.', 'Lỗi!');
                console.error('Error:', error);
            },
            complete: function() {
                submitBtn.prop('disabled', false);
                submitBtn.text('Gửi liên hệ');
            }
        });
    });
});

    </script>
</body>
</html>