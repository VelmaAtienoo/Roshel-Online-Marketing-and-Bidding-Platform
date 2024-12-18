<?php
include("connect.php");
session_start();
//if (!isset($_SESSION['username'])) {
//header("location:index.php");
//}
?>
<?php

if (isset($_POST['btnstart'])) {
    header("location:wl_product.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roshel Bazzar</title>



    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-image: url("bgimgs/pexels-anastasia-shuraeva-5705095.jpg");
            background-repeat: no-repeat;
            width: 100%;
            height: 100vh;
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;

        }

        .content {
            position: absolute;
            top: 40%;
            left: 4%;
            width: 40%;
            height: 30vh;
            border-radius: 5px;
        }

        h1 {
            font-size: 200%;
            color:rgb(8, 43, 19);
        }

        b {

            font-size: 130%;
            color:rgb(8, 43, 19);

        }

        h3 {
            font-size: 160%;
            color:rgb(80, 12, 143);
        }

        .btnstart {
            width: 35%;
            height: 5vh;
            background-color:rgb(3, 58, 6);
            color: #FFF;
            font-size: 105%;
            border: solid 1px white;
            border-radius: 5px;
            transition: all ease 0.5s;
        }

        .btnstart:hover {
            width: 36%;
            height: 6vh;
            background-color: #6b3eff;
            filter: drop-shadow(1px 1px 10px rgb(255 255 255 / 90%));
            transition: all ease 0.5s;
        }

        @media screen and (max-width: 768px) {

            .content {
                position: absolute;
                top: 40%;
                left: 4%;
                width: 100%;
                height: 30vh;
                border-radius: 5px;
            }

            h1 {
                font-size: 40px;
                color: #ADD8E6;
            }

            h3 {
                font-size: 35px;
                color: #9B30FF;
                pad: 20px;
            }

            .btnstart {
                width: 55%;
                height: 5vh;
                background-color: #7A52FF;
                color: #FFF;
                font-size: 20px;
                border: solid 1px white;
                border-radius: 5px;
                transition: all ease 0.5s;
            }

        }
    </style>
</head>



<body>
    <form action="" method="POST">

        <?php include 'navbar.html'; ?>


        <div class="content">
            <h1>Hello <b>GuestUser</b></h1>
            <h3 style="margin-top:1%">Win An Auction & Take Your Things </h3>

            <input type="submit" name="btnstart" value="Start Shopping" class="btnstart" style="margin-top:3%">
        </div>



        <script>
            function toggleMenu() {
                var navLinks = document.querySelector('.nav-links');
                navLinks.classList.toggle('active');
            }

            function toggleSearch() {
                var searchBar = document.querySelector('.search-bar');
                searchBar.style.display = searchBar.style.display === 'none' ? 'block' : 'none';
            }
        </script>

    </form>
</body>

</html>