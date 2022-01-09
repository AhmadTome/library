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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>
<style>
    .main-section {
        position: relative;
        background: linear-gradient(rgba(0, 0, 0, .7), rgba(235, 82, 73, .7), rgba(0, 0, 0, .7)), url("imgs/banner.jpg");
        height: 600px;
        width: 100%;
        background-size: cover;
    }

    .main-section i {
        font-size: 35px;
        color: #fff;
        position: absolute;
        left: 50%;
        bottom: 15px;
        transform: translateX(-50%);
    }

    .main-section .section-part {
        color: #fff;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    @-webkit-keyframes blinker {
        from {
            opacity: 1.0;
        }
        to {
            opacity: 0.0;
        }
    }
    label, select, .dataTables_info, .paginate_button  {
        color: white !important;
    }

    #example_filter{
        direction: rtl;

    }
    #example_wrapper {
        padding: 15px;
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
        <div class="">
            <table id="example" class="table " style="color: white !important;">
                <thead>
                <tr>
                    <th></th>
                    <th>تم دفع المستحقات مالية؟</th>
                    <th>مستحقات مالية</th>
                    <th>الحالة</th>
                    <th>تاريخ الإرجاع</th>
                    <th>تاريخ الاشتراك</th>
                    <th>اسم الكتاب</th>
                    <th>رقم هاتف المشترك</th>
                    <th>اسم المشترك</th>
                    <th>الرقم التسلسلي</th>
                </tr>
                </thead>
                <tbody style="color: #0c0c0c; text-align: center">

                </tbody>
            </table>
        </div>


    </div>
</div>

</body>
</html>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json"
            },
            "ajax": {
                "url": "database/listOfReservations.php",
                "dataSrc": function (json) {
                    return json;
                }
            },
            "columns": [

                {
                    "data": function (row, type, val, meta) {
                        return "<button class='btn btn-primary edit' data-id='"+ row.reservation_id +"'>تعديل</button>";
                    }

                },
                {
                    "data": function (row, type, val, meta) {
                        if (row.paid_financial_penalty == 0) {
                            return "لا حاجة";
                        } else if (row.paid_financial_penalty == "true") {
                            return "تم الدفع";
                        } else if (row.paid_financial_penalty == "false") {
                            return "لم يتم الدفع";
                        } else {
                            return row.paid_financial_penalty;
                        }
                    }

                },
                {"data": "financial_penalty"},
                {
                    "data": function (row, type, val, meta) {
                            return row.status;
                    }

                },
                {"data": "back_date"},
                {"data": "subscribe_date"},
                {"data": "book_name"},
                {"data": "subscriber_phone"},
                {"data": "subscriber_name"},
                {"data": "reservation_id"},


            ]
        });

        $(document).on('click','.edit', function () {
            var id = $(this).attr('data-id');
            window.location = '/library/editReservation.php?id='+id
        })

    });
</script>
