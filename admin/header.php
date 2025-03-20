<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $system['title'] ?></title>
    <meta name="description" content="<?= $system['keyword'] ?>">
    <meta name="keywords" content="<?= $system['keyword'] ?>">
    <script src="/assest/admin/js/bootstrap.bundle.min.js?v=1"></script>
    <link rel="stylesheet" href="/assest/admin/css/bootstrap.min.css?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        /* Tạo bóng cho card và hiệu ứng hover */
.card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Thêm màu nền cho header và làm nổi bật */
.card-header {
    background-color: #ffc107;
    color: white;
    font-weight: bold;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}





/* Tạo hiệu ứng cho nội dung trong card */
.card-body {
    padding: 30px;
    background-color: #f9f9f9;
    border-radius: 10px;
    font-size: 16px;
}
/* Tùy chỉnh tiêu đề card */
.card-title {
    font-size: 1.5rem;
    color: #333;
}

/* Tạo khoảng cách cho các thành phần bên trong card */
.card-body .form-group {
    margin-bottom: 1rem;
}

/* Cải thiện style của các input */
.form-control {
    border-radius: 10px;
    border: 1px solid #ddd;
    padding: 8px 12px; /* Giảm padding để làm nhỏ input */
    font-size: 14px; /* Giảm kích thước font chữ */
    height: auto; /* Đảm bảo chiều cao vừa phải */
    transition: border-color 0.3s ease;
    
}



.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
}
/* Chỉnh sửa mũi tên cho select */
.custom-select {
    -webkit-appearance: none; /* Tắt mũi tên mặc định */
    -moz-appearance: none;
    appearance: none;
    padding-right: 30px; /* Tạo khoảng trống cho mũi tên */
    background-image: url('/assest/img/down-arrow.png'); /* Thêm mũi tên */
    background-position: right 10px center; /* Vị trí mũi tên ở bên phải */
    background-repeat: no-repeat; /* Không lặp lại mũi tên */
    background-size: 12px; /* Kích thước mũi tên */
    border: 1px solid #ccc; /* Viền xung quanh */
}

/* Tùy chỉnh khi focus vào select */
.custom-select:focus {
    border-color: #007bff; /* Màu viền khi focus */
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3); /* Hiệu ứng shadow khi focus */
}
.naminc1 {
    text-shadow: 0 0 5px #0099FF, 0 0 5px #FF66FF, 1px 1px 0 #FF3333;
 color: white;
font-weight: bold;
    font-weight: red ;
    background: url(https://i.imgur.com/1ZHeaAQ.gif);
}
.naminc2 {
    background: url("https://i.imgur.com/1ZHeaAQ.gif") repeat scroll 0 0%,url("https://i.imgur.com/1ZHeaAQ.gif") repeat scroll 0 0;
    color: #fff;
    font-weight: bold;
    text-shadow: 0 0 3px #4287f5,0 0 7px #4287f5;
}
.naminc3 {
color: #43cc84;
font-weight: bold;
background-image: url(https://i.imgur.com/i8yb81c.gif);
text-shadow: 0 0 5px #43cc84;
}
.naminc4 {
   color: #ff0000;
font-weight: bold;
background-image: url(https://i.imgur.com/ELhX94s.gif);
text-shadow: 0 0 5px #f00;
}


    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-warning">
        <div class="container-fluid">
            <a class="navbar-brand naminc1" href="/admin/"><?= $system['name'] ?></a>
        </div>
    </nav>

</body>