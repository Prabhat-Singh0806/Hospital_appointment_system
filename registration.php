<?php
$admin = $_REQUEST['admin'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['patient_registration'])) {
        include 'dbconfig.php';
        $sFName = $_REQUEST['vFName'];
        $sLName = $_REQUEST['vLName'];
        $sGender = $_REQUEST['vGender'];
        $sEmail = $_REQUEST['vEmail'];
        $sMobile = $_REQUEST['vMobile'];
        $password = $_REQUEST['vPassword'];
        $cpassword = $_REQUEST['vCPassword'];

        if ($password != $cpassword) {
            $warning = "&#9888; password didn,t match try again";
        } else {
            //checking if user alredy exist
            $sql = "SELECT * FROM patreg WHERE email = '$sEmail'"; //checking for already registered email
            $returnpatient = mysqli_query($conn, $sql);
            if (!$returnpatient) {
                echo -10;
            }
            $val = mysqli_num_rows($returnpatient);
            if ($val != 0) {
                $same_email = "&#9888;  Already existing email try with another";

            } else {
                $sql = "INSERT INTO `patreg` (`fname`, `lname`, `gender`, `email`, `contact`, `password`, `cpassword`) VALUES ('$sFName', '$sLName', '$sGender', '$sEmail', '$sMobile', '$password', '$cpassword');";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $warning = "Patient Registration Unsuccesfull try again";
                }
            }
        }

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
            width: 50%;
            height: fit-content;

            border: 1px solid black;
        }

        .icon,
        .header,
        .formheader,
        .formtable {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 5px;
        }

        form {
            width: 100%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 5px;
            /* flex-direction: column; */
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

        label {
            width: 30%;
            margin-bottom: 10px;
            font-size: 18px;
        }

        input {
            width: 50%;
            font-size: 18px;
            padding: 5px;
            margin-bottom: 10px;
            outline: none;
            border: none;
            border-bottom: 2px solid #c7c3c3;
            color: #67676a;
        }

        input:hover {
            border-bottom: 2px solid #4745e7;
        }

        input::placeholder {
            color: #c7c3c3;
            font-size: 14px;
        }


        input[type=radio] {
            width: fit-content;
            margin: none;
        }

        .submit_btn {
            width: 40%;
            height: fit-content;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 5px;
        }

        .gender {
            width: 50%;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .gender label {
            width: 20%;
            margin-left: 5px;

        }


        .btn {
            width: 90%;
            border: none;
            background-color: blue;
            color: white;
            padding: 7px;
        }

        .back_btn {
            text-decoration: none;
            width: 90%;
            border: none;
            background-color: blue;
            color: white;
            padding: 5px;
            display: block;
            text-align: center;
            height: 50%;
        }

        #up {
            margin-top: 20px;
        }

        #back {
            margin-bottom: 20px;
        }

        .showpassword {
            display: flex;
            width: 90%;
            flex-wrap: wrap;
            margin-top: 10px;
            margin-bottom: 30px;
            font-size: 17px;
            align-content: center;
            justify-content: center;

        }

        .showpassword input {
            width: 5%;
            height: 70%;
        }

        .showpassword label {
            /* width: 90%; */
            padding-left: 5px;
        }

        @media only screen and (max-width: 500px) {
            .showpassword label {
                width: 90%;
            }

            .showpassword input {
                width: 10%;
                height: 70%;
            }

            .container {
                width: 95%;
                border: none;
            }

            input,
            .btn,
            .back_btn {
                height: 35px;
                font-size: 18px
            }

            .gender,
            label,
            input {
                width: 90%;
            }

            body {
                height: 120vh;
            }

            input {
                margin-bottom: 15px;
            }

            label {
                margin-bottom: 3px;
                font-size: 16px;
            }

            .gender label {
                margin-bottom: 12px;
            }

            .submit_btn {
                width: 95%;
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
            if ($result) {
                ?>
                <div class="formheader" style="text-align: center;">
                    <h3>Patient Registration Succesfull you can login now</h3>
                </div>
                <div class="submit_btn" style="width: 100%;">
                    <?
                    if (isset($admin)) {
                        ?>
                        <a href="adminsample.php" class="back_btn">Click to continue</a>
                    <?
                    } else {
                        ?>
                        <a href="index.html" class="back_btn">Click to continue</a>
                    </div>
                <?
                    }
            }
            if (!$result) {
                ?>
                <div class="formheader">
                    <h3>Patient Registration</h3>
                    <?
                    if (isset($warning)) {
                        echo "&nbsp;<font color='red'><b>" . $warning . "</b></font>";
                    }
                    if (isset($same_email)) {
                        echo "&nbsp;<font color='red'><b>" . $same_email . "</b></font>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post" name="registration_form">

                        <label for="vFName"><b>First name</b></label>
                        <input type="text" placeholder="Enter First name" name="vFName" id="vFName" required
                            pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vLName"><b>Last name</b></label>
                        <input type="text" placeholder="Enter last name" name="vLName" id="vLName" required
                            pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vGender"><b>Gender</b></label>
                        <div class="gender">
                            <input type="radio" name="vGender" id="Male" required value="Male"><label
                                for="Male">Male</label>
                            <input type="radio" name="vGender" id="Female" required value="Female"><label
                                for="Female">Female</label>
                        </div>

                        <label for="vEmail"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="vEmail" id="vEmail" required>

                        <label for="vMobile"><b>Mobile</b></label>
                        <input type="tel" placeholder="Enter 10 digit mobile number" name="vMobile" maxlength="10"
                            id="vMobile" required pattern="[0-9]{10}" title="Only 10 digit numbers are allowed">

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="vPassword" id="psw" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="vCPassword" id="psw-repeat" required>
                        <div class="showpassword">
                            <input type="checkbox" id="show" onclick="showfunction()"><label for="show">Show
                                Password</label>
                        </div>
                        <div class="submit_btn">
                            <button class="btn" type="submit" name="patient_registration">Register</button>
                        </div>
                        <div class="submit_btn">
                            <?
                            if (isset($admin)) {
                                ?>
                                <a href="adminsample.php" class="back_btn">Back</a>
                            <?
                            } else {
                                ?>
                                <a href="index.html" class="back_btn">Back</a>
                            </div>
                        <?
                            }
                            ?>
                    </form>
                </div>
            <?
            }
            ?>
        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        function showfunction() {
            var x = document.getElementById("psw");
            var y = document.getElementById("psw-repeat");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            }
            else {
                x.type = "password";
                y.type = "password";
            }
        }  
    </script>
</body>

</html>