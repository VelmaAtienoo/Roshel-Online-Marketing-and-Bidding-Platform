<?php
session_start();
include("connect.php");
if (isset($_SESSION['username'])) {
    header("location:home.php");
}
// if (isset($_SESSION['vusername'])) {
//     header("location:vender_homepage.php");
// }
if (isset($_POST['btnsubmit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT user_id, username, password FROM tbl_user WHERE username='$username'";
    $vselect = "SELECT vid, vuser_name, vpassword FROM tbl_vender WHERE vuser_name='$username'";

    $check = mysqli_query($connect, $select);
    $vcheck = mysqli_query($connect, $vselect);

    // Ensure results are not null
    $result = mysqli_num_rows($check) > 0 ? mysqli_fetch_assoc($check) : null;
    $vresult = mysqli_num_rows($vcheck) > 0 ? mysqli_fetch_assoc($vcheck) : null;

    $userid = $result ? $result['user_id'] : null;
    $user = $result ? $result['username'] : null;
    $encpass = $result ? $result['password'] : null;

    $veid = $vresult ? $vresult['vid'] : null;
    $vuser = $vresult ? $vresult['vuser_name'] : null;
    $vencpass = $vresult ? $vresult['vpassword'] : null;

    if ($result) {
        $fpass = md5($password);
        if ($fpass == $encpass) {
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $userid;

            header("location:home.php");
            exit();
        } else {
            echo '<script>alert("Either Username Or Password Is Wrong")</script>';
        }
    }

    if ($vresult) {
        $fpass = md5($password);
        if ($fpass == $vencpass) {
            $_SESSION['vusername'] = $username;
            $_SESSION['vender_id'] = $veid;

            header("location:vender_homepage.php");
            exit();
        } else {
            echo '<script>alert("Either Username Or Password Is Wrong")</script>';
        }
    }

    // Admin login
    if ($username == "admin" && $password == "Krup@l1") {
        $_SESSION['admin'] = $password;
        header("location:admin.php");
        exit();
    } else {
        echo '<script>alert("Either Username Or Password Is Wrong")</script>';
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="singup.css">
    <title>Bid Bazzar</title>
    <script>
        function validateForm() {
            var uname = document.getElementById('uname').value;
            var password = document.getElementById('password').value;

            if (uname.trim() == '' || password.trim() == '') {
                alert('Username and password are required!');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>

</head>

<body>

    <form action="" method="POST" onsubmit="return validateForm()">
        <div class="container" onclick="onclick">
            <div class="top"></div>
            <div class="bottom"></div>

            <div class="center">

                <h2><b>Bid Bazzar</b></h2>

                <input type="text" placeholder="User Name" name="username" id="uname" />
                <input type="password" placeholder="Password" name="password" id="password" />
                <p><b>Don't Have An Account?<a href="opction.html">SIGNUP</a></b><br>
                <b>Visit Web Site <a href="index.php"> Guest User</a></b></p>
                <input type="Submit" value="Login" id="button" name="btnsubmit" id="button" />


            </div>
        </div>
    </form>
</body>

</html>