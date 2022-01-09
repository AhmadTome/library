<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location:login.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>المكتبة الاكترونية</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style>
    .main-section{
        position: relative;
        background:linear-gradient(rgba(0, 0, 0, .7), rgba(235, 82, 73, .7), rgba(0, 0, 0, .7)), url("imgs/banner.jpg");
        height:600px;
        width: 100%;
        background-size: cover;
    }
    .main-section i{
        font-size:35px;
        color:#fff;
        position:absolute;
        left:50%;
        bottom:15px;
        transform: translateX(-50%);
    }
    .main-section .section-part{
        color:#fff;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    @-webkit-keyframes blinker {
        from {opacity: 1.0;}
        to {opacity: 0.0;}
    }
    .blink{
        text-decoration: blink;
        -webkit-animation-name: blinker;
        -webkit-animation-duration: 0.6s;
        -webkit-animation-iteration-count:infinite;
        -webkit-animation-timing-function:ease-in-out;
        -webkit-animation-direction: alternate;
    }
</style>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark" dir="rtl">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="home.php">الصفحة الرئيسية</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="#"> اهلا بك <?php echo $_SESSION['Name'] ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="addBook.php">إضافة كتاب جديد</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="reserveBook.php">حجز كتاب</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="reservationsList.php">صفحة الحجوزات</a>
        </li>
        <li class="nav-item" style="float: left">
            <a class="nav-link" href="helper/kill_session.php">تسجيل خروج</a>
        </li>
    </ul>
</nav>

<div class="">
    <div class="main-section">
        <div class="row">



            <div class="container" style="color: white; text-align: right" dir="rtl">
                <p class="text-right" style="color: greenyellow">
                    <?php
                    if (isset($_SESSION['Success'])) {
                        echo $_SESSION['Success'];
                        unset($_SESSION['Success']);

                    }
                    ?>
                </p>

                <p class="text-right" style="color: red">
                    <?php
                    if (isset($_SESSION['Error'])) {
                        echo $_SESSION['Error'];
                        unset($_SESSION['Error']);

                    }
                    ?>
                </p>

                <form action="database/add_book.php" method="post">
                    <div class="form-group">
                        <label for="driver_name">اسم الكتاب</label>
                        <input type="text" class="form-control" id="book_name" placeholder="ادخل اسم الكتاب هنا" name="book_name" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">رقم الكتاب</label>
                        <input type="text" class="form-control" id="book_number" placeholder="ادخل رقم الكتاب هنا" name="book_number" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">اسم دار النشر</label>
                        <input type="text" class="form-control" id="publish_name" placeholder="ادخل اسم دار النشر هنا" name="publish_name" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">اسم المؤلف</label>
                        <input type="text" class="form-control" id="author_name" placeholder="ادخل اسم المؤلف هنا" name="author_name" required>
                    </div>


                    <button type="submit" class="btn btn-primary">ادخال الكتاب</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {


        $('#start_at').on('change', function () {
            var start_at = $(this).val();

            var oldDateObj = new Date(start_at);
            var newDateObj = new Date();
            newDateObj.setTime(oldDateObj.getTime() + (40 * 60 * 1000));
            var end_date = newDateObj.toLocaleDateString("en-US");
            var end_time = (newDateObj+"").split(' ')[4];

            var endTimeHour = (end_time+"").split(':')[0];
            var new_hour = parseInt(endTimeHour) > 12 ? parseInt(endTimeHour) - 12 : parseInt(endTimeHour);
            end_time = end_time.replace(endTimeHour, new_hour)

            var end_at = end_time+" "+end_date
            $('#end_at').val(end_at);

        });
    });
</script>
