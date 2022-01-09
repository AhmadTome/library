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

                <form action="database/reserve_book.php" method="post">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <select class="form-control" name="bookId">
                                <option value="0" selected disabled>اختر كتاب</option>
                                <?php
                                $books = getBooks();
                                foreach ($books as $item) {
                                    echo '<option value="'. $item['id'] .'">'. $item['book_name'] .'</option>';

                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="driver_name">اسم المشترك</label>
                        <input type="text" class="form-control" id="subscriber_name" placeholder="ادخل اسم المشترك هنا" name="subscriber_name" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">هاتف المشترك</label>
                        <input type="text" class="form-control" id="subscriber_phone" placeholder="ادخل هاتف المشترك هنا" name="subscriber_phone" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">تاريخ الاشتراك</label>
                        <input type="date" class="form-control" id="subscribe_date" name="subscribe_date" required>
                    </div>
                    <div class="form-group">
                        <label for="driver_name">تاريخ الإرجاع</label>
                        <input type="date" class="form-control" id="back_date" name="back_date" required>
                    </div>


                    <button type="submit" class="btn btn-primary">تسجيل الاشتراك</button>
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


<?php

function getBooks()
{
    $servername = "localhost";
    $username = "books";
    $password = "";

    $conn = mysqli_connect($servername, "root",$password, $username,"3306");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($conn,"utf8");

    $query = "SELECT * FROM `books` order by id desc";
    $result = $conn->query($query);
    $books = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($books,
                [
                    "id" => $row["id"],
                    "book_name" => $row["book_name"],
                    "book_number" => $row["book_number"],
                    "publish_name" => $row["publish_name"],
                    "author_name" => $row["author_name"],
                ]
            );
        }
    }

    return $books;
}

?>
