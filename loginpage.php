<?php

$status = $_REQUEST['login'];

if (isset($_POST['patient_login'])) {
    include 'dbconfig.php';
    $email = trim($_REQUEST["pemail"]);
    $password = $_REQUEST["ppassword"];

    $sql = "SELECT * FROM patreg WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -10;
    }
    $val = mysqli_num_rows($result);

    if ($val == 1) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['$username'] = $email;

        header("location: patientsample.php");
    } else {
        $patient_warning = "&#9888; Invalid login credentials, try again !";
    }
}

if (isset($_POST['doctor_login'])) {
    include 'dbconfig.php';
    $username = trim($_REQUEST["Username"]);
    $password = $_REQUEST["password"];

    $sql = "SELECT * FROM doctb WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -10;
    }
    $val = mysqli_num_rows($result);

    if ($val == 1) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['$doctorusername'] = $username;
        header("location: doctorsample.php");
    } else {
        $doctor_warning = "&#9888; Invalid login credentials, try again !";
    }
}
if (isset($_POST['admin_login'])) {
    include 'dbconfig.php';
    $username = $_REQUEST["Username"];
    $password = $_REQUEST["password"];

    $sql = "SELECT * FROM admintb WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -10;
    }
    $val = mysqli_num_rows($result);

    if ($val == 1) {
        session_start();
        $_SESSION['loggedIn'] = true;
        $_SESSION['$adminusername'] = $username;
        header("location: adminsample.php");
    } else {
        $admin_warning = "&#9888; Invalid login credentials, try again !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginpage</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            height: 100vh;
            overflow: scroll;
            align-content: center;
        }

        .container {
            width: 20%;
            height: fit-content;
            border: 1px solid black;
        }

        .icon,
        .header,
        .formheader,
        .formtable,
        form,
        .formfooter {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 5px;
        }

        .formfooter {
            margin-bottom: 20px;
        }

        hr {
            border: 1px solid black;
            width: 85%;
            margin-top: 10px;

        }

        .icon img {
            width: 50px;
            height: 50px;
        }

        .username,
        .password {
            width: 90%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            border-bottom: 2px solid #ddd;
            /* padding: 5px;  */
            margin-bottom: 25px;
        }

        .password {
            margin-bottom: 15px;
        }

        .showpassword {
            display: flex;
            width: 90%;
            flex-wrap: wrap;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 17px;
            align-items: center;

        }

        .showpassword input {
            width: 10%;
            height: 100%;
        }

        .showpassword label {
            width: 90%;
            padding-left: 5px;
        }

        .password:hover {
            border-bottom: 2px solid #4745e7;
        }

        .username:hover {
            border-bottom: 2px solid #4745e7;
        }

        .submit_btn {
            width: 80%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 5px;

        }

        input {
            width: 85%;
            font-size: 15px;
            /* margin-bottom: 10px; */
            /* padding: 5px; */
            border: none;
            outline: none;
            background-color: transparent;
        }

        input::placeholder {
            font-size: 17px;

        }

        input::placeholder:hover {
            color: #4745e7;
        }

        .input_icon {
            width: 15%
        }

        .input_icon img {
            width: 60%;
            height: 60%;

        }

        .btn {
            width: 100%;
            border: none;
            background-color: blue;
            color: white;
            padding: 5px;
            font-size: 15px
        }

        .back_btn {
            text-decoration: none;
            width: 100%;
            border: none;
            background-color: blue;
            color: white;
            padding: 5px;
            display: flex;
            /* text-align: center; */
            align-items: center;
            justify-content: center;
        }

        #up {
            margin-top: 20px;
        }

        #back {
            margin-bottom: 20px;
        }

        .envelop {
            background-image: url("image/envelope-solid.svg");
        }

        @media only screen and (max-width: 500px) {
            .container {
                width: 95%;
            }

            input {
                height: 35px;
                font-size: 18px
            }

            .back_btn,
            .btn {
                height: 35px;
                font-size: 18px
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="icon" id="up">
            <img src="image/solidarity1.png">
        </div>
        <div class="header">
            <h2>Assp Hospital</h2>
            <hr>
        </div>

        <div class="form">
            <?
            if ($status == "patient") {
                ?>
                <div class="formheader">
                    <h3>Patient login</h3>
                    <?
                    if (isset($patient_warning)) {
                        echo "<p><font color='red'>" . $patient_warning . "</font></p>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post" id="patientform">
                        <div class="username">
                            <div class="input_icon">
                                <img src="image/envelope-fill.svg">
                            </div>
                            <input type="email" name="pemail" id="email" placeholder=" Email" required>
                        </div>
                        <div class="password">
                            <div class="input_icon">
                                <img src="image/unlock-fill.svg">
                            </div>
                            <input type="password" name="ppassword" id="password" placeholder=" Password" required>
                            <input type="hidden" name="login" value="patient">
                        </div>
                        <div class="showpassword">
                            <input type="checkbox" id="show" onclick="showfunction()"><label for="show">Show
                                Password</label>
                        </div>
                        <div class="submit_btn">
                            <button class="btn" type="submit" name="patient_login">Login</button>
                        </div>
                        <div class="submit_btn">
                            <a href="index.html" class="back_btn">Back</a>
                        </div>
                    </form>
                </div>
                <div class="formfooter">
                    <p>Don't have Account yet ? <a href="registration.php">Register Now</a></p>
                </div>
            <?
            }
            if ($status == "doctor") {
                ?>
                <div class="formheader">
                    <h3>Doctor login</h3>
                    <?
                    if (isset($doctor_warning)) {
                        echo "<p><font color='red'>" . $doctor_warning . "</font></p>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post">
                        <div class="username">
                            <div class="input_icon">
                                <img src="image/person-fill.svg">
                            </div>
                            <input type="text" name="Username" id="Username" placeholder=" Username" required>
                        </div>
                        <div class="password">
                            <div class="input_icon">
                                <img src="image/unlock-fill.svg">
                            </div>
                            <input type="password" name="password" id="password" placeholder=" Password" required>
                            <input type="hidden" name="login" value="doctor">
                        </div>
                        <div class="showpassword">
                            <input type="checkbox" id="show" onclick="showfunction()"><label for="show">Show
                                Password</label>
                        </div>
                        <div class="submit_btn">
                            <button class="btn" type="submit" name="doctor_login">Login</button>
                        </div>
                        <div class="submit_btn" id="back">
                            <a href="index.html" class="back_btn">Back</a>
                        </div>
                    </form>
                </div>
                <!-- <div class="formfooter">
                                                    <p>Don't have Account yet ? <a href="signup.html" >Register Now</a></p>
                                                </div> -->
            <?
            }
            if ($status == "admin") {
                ?>
                <div class="formheader">
                    <h3>Admin login</h3>
                    <?
                    if (isset($admin_warning)) {
                        echo "<p><font color='red'>" . $admin_warning . "</font></p>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post">
                        <div class="username">
                            <div class="input_icon">
                                <img src="image/person-fill-gear.svg">
                            </div>
                            <input type="text" name="Username" id="Username" placeholder=" Username" required>
                        </div>
                        <div class="password">
                            <div class="input_icon">
                                <img src="image/unlock-fill.svg">
                            </div>
                            <input type="password" name="password" id="password" placeholder=" Password" required>
                            <input type="hidden" name="login" value="admin">
                        </div>
                        <div class="showpassword">
                            <input type="checkbox" id="show" onclick="showfunction()"><label for="show">Show
                                Password</label>
                        </div>
                        <div class="submit_btn">
                            <button class="btn" type="submit" name="admin_login">Login</button>
                        </div>
                        <div class="submit_btn" id="back">
                            <a href="index.html" class="back_btn">Back</a>
                        </div>
                    </form>
                </div>
                <!-- <div class="formfooter">
                                                    <p>Don't have Account yet ? <a href="signup.html" >Register Now</a></p>
                                                </div> -->
            <?
            }
            ?>
        </div>
    </div>
    <script>
        function showfunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            }
            else {
                x.type = "password";
            }
        }       
    </script>
</body>

</html>