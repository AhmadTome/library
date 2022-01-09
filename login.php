<?php
session_start();

include ('header.php');
?>

<body>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="imgs/logo.png" id="icon" alt="User Icon" />
        </div>



        <!-- Login Form -->
        <form action="database/login.php" method="post">
            <input type="text" id="login" class="fadeIn second" name="email" placeholder="email">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="********">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>
        <p class="text-right" style="color: red">
            <?php
            if (isset($_SESSION['Error'])) {
                echo $_SESSION['Error'];
                unset($_SESSION['Error']);

            }
            ?>
        </p>
        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="signup.php">Sign Up?</a>
        </div>

    </div>
</div>


</body>
