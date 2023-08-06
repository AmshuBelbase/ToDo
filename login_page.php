<?php

date_default_timezone_set("Asia/Kathmandu");
if (isset($_COOKIE["id"])) {
    if (isset($_COOKIE["idname"])) {
        $id = $_COOKIE["id"];
        $idname = $_COOKIE["idname"];
        if ($id != "" and $idname != "") {
            echo "<script>window.location.href ='/todo/';</script>";
        } else {

        }
    }

}

?>

<?php
$hostname = "sql101.epizy.com";
$username = "epiz_32083127";
$password = "0SNleKCj3N0AS4";
$dbname = "epiz_32083127_uMqO9Otmp1";

$con = mysqli_connect($hostname, $username, $password, $dbname);

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $email = $_POST['email'];
    $result = mysqli_query($con, "select * from userdata where Passcode='$password' AND Email='$email'");
    $user = mysqli_query($con, "select UserName from userdata where Passcode='$password' AND Email='$email'");

    $userdata = mysqli_fetch_array($user);


    if (mysqli_num_rows($result) > 0) {


        $timestampp = mysqli_query($con, "select timestamp from userdata where Passcode='$password' AND Email='$email'");
        $usertime = mysqli_fetch_array($timestampp);
        $user_recent_time = $usertime["timestamp"];
        $ID = mysqli_query($con, "select ID from userdata where Passcode='$password' AND Email='$email'");
        $userIDd = mysqli_fetch_array($ID);
        $userID = $userIDd["ID"];


        $date = date("Y-m-d H:i:s");
        $dateinsec = strtotime($date);
        $user_recent_timeinsec = strtotime($user_recent_time);
        $interval = $dateinsec - $user_recent_timeinsec;

        if ($interval > 10) {
            $update_stat = mysqli_query($con, "UPDATE `userdata` SET `timestamp`= '$date' WHERE Passcode='$password' AND Email='$email'");

            $usercook = $userdata["UserName"];
            setcookie("idname", $usercook, time() + 2592000, "/");
            setcookie("id", $userID, time() + 2592000, "/");

            echo "<script>window.location.href ='/todo/';</script>";
        } else {
        }
    } else {
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Log In</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width:device-width, initial-scale=1">
</head>
<script src="sweetalert.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style type="text/css">
    body {
        margin: 0;
        background: url(images.jpg);
        background-attachment: fixed;
        background-position: center;
    }

    .form {
        margin-left: 0cm;
        margin-top: 0cm;
        position: absolute;
        width: 100%;
        height: 20cm;
    }

    .loginbox {
        width: 320px;
        background-image: linear-gradient(#2088bd, #2088bd, #2088bd, black, black);
        background-attachment: fixed;
        background-size: cover;
        border-radius: 30px;
        color: #fff;
        margin-top: 3cm;
        margin-left: 36%;
        position: absolute;
        box-sizing: border-box;
        padding: 70px 30px;
        opacity: 0.8;
    }

    .avatar {
        width: 120px;
        height: 120px;
        border-radius: 40%;
        position: absolute;
        top: -60px;
        left: calc(47% - 50px);
    }

    @media only screen and (max-width: 480px) {
        .loginbox {
            margin-left: 10%;
        }

        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: absolute;
            top: -50px;
            left: calc(50% - 50px);
        }

    }

    h1 {
        margin: 0;
        margin-bottom: 10px;
        padding: 0 0 10px;
        text-align: center;
        font-size: 22px;
    }

    .loginbox p {
        margin: 0 170px 0 0;
        padding: 0;
        font-weight: bold;
    }

    .loginbox input {
        width: 100%;
        margin-bottom: 10px;
    }

    .loginbox input[type="text"],
    input[type="password"],
    input[type="email"] {
        border: none;
        border-bottom: 1px solid #fff;
        background: transparent;
        outline: none;
        height: 40px;
        color: #fff;
        font-size: 20px;
    }

    .loginbox input[type="submit"] {
        border: none;
        outline: none;
        height: 40px;
        background: #fb2525;
        color: white;
        font-size: 18px;
        border-radius: 20px;
    }

    .loginbox a {
        text-decoration: none;
        margin-left: 70px;
        padding: 10px 10px 10px 10px;
        border-radius: 20px;
        background-color: lightblue;
        font-size: 20px;
        line-height: 20px;
        color: black;
    }

    button {
        text-decoration: none;
        margin-left: 0px;
        padding: 10px 10px 10px 10px;
        border: none;
        border-radius: 20px;
        background-color: transparent;
        font-size: 15px;
        line-height: 20px;
        color: white;
    }

    .loginbox input[type="submit"]:hover {
        cursor: progress;
        background: lightblue;
        color: black;
        border-radius: 8px;
    }

    .loginbox a:hover {
        color: white;
        cursor: pointer;
        background: purple;
        border-radius: 20px;
    }

    button:hover {
        color: orange;
        cursor: pointer;
        border-radius: 20px;
    }

    .loginbox p:hover {
        color: lightblue;
        cursor: pointer;
        background: red;
        border-radius: 8px;
        font-family: DiskusDMed;
        font-size: 20px;
        transition-delay: 0.09s;
        margin-right: 160px;
        transition-duration: 0.3s;
    }

    .loginbox input[type="email"]:hover {
        color: black;
        cursor: text;
        background: white;
        font-family: Cuneiform;
        border-radius: 8px;
    }

    .loginbox input[type="password"]:hover {
        color: black;
        font-family: segeo script;
        cursor: text;
        background: white;
        border-radius: 8px;
    }

    .loginbox input[type="text"]:hover {
        color: black;
        cursor: text;
        background: white;
        font-family: Cuneiform;
        border-radius: 8px;
    }

    h1:hover {
        color: white;
        cursor: pointer;
        font-family: AlgerianBasD;
        background: lime;
        border-radius: 20px;
    }

    .avatar:hover {
        border-radius: 20px;
        cursor: zoom-in;
    }

    .loginbox:hover {
        border-radius: 60px;
    }

    .dont {
        font-size: 25px;
        margin-bottom: 25px;
        margin-top: 20px;
    }

    @media only screen and (max-width: 480px) {
        .dont {
            font-size: 20px;
        }
    }
</style>

<body>
    <center style="color: white;">&copy; Amshu Belbase
        <?php echo date("Y"); ?>
    </center>
    <div class="form">
        <div class="loginbox" id="1">
            <img src="welcomelogo.png" class="avatar">
            <h1> Welcome </h1>


            <form action="login_page.php" method="POST">

                <p> Email </p>
                <input type="email" placeholder="Enter Email" id="email" maxlength="100" name="email" required>

                <p> Password </p>
                <input type="password" placeholder="Enter Password" id="password" maxlength="60" name="password"
                    required>
                <button type="button" onclick="window.location.href= '/forget_psd.php'"># Forget Password ?</button>
                <input type="submit" value="Login" id="submit" name="submit">

                <div class="dont"># Don't have an account?</div>
                <a href="../sign_up.php"> !! SIGN UP !! </a><br>
            </form>


        </div>

    </div>

</body>

</html>