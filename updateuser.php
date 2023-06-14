<?php
include 'session.php';
include 'dbconfig.php';
$pid = $_REQUEST['pid'];


$sql = "SELECT * FROM patreg WHERE pid = '$pid'";
$return = mysqli_query($conn, $sql);

if ($return) {
    while ($getdata = mysqli_fetch_assoc($return)) {
        $pid = $getdata['pid'];
        $fname = $getdata['fname'];
        $lname = $getdata['lname'];
        $gender = $getdata['gender'];
        $email = $getdata['email'];
        $mobile = $getdata['contact'];
        $rpassword = $getdata['password'];
        $rcpassword = $getdata['cpassword'];
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['patient_updation'])) {
        $pid = $_REQUEST['pid'];
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
            if ($email != $sEmail) {
                $sql = "SELECT * FROM patreg WHERE email = '$sEmail'"; //checking for already registered email
                $return2 = mysqli_query($conn, $sql);
                if (!$return2) {
                    echo -10;
                    exit();
                }
                $val = mysqli_num_rows($return2);
                if ($val != 0) {
                    $same_email = "&#9888; Already existing email";
                } else {
                    $sql = "UPDATE `patreg` SET `fname` = '$sFName', `lname` = '$sLName', `gender` = '$sGender', `email` = '$sEmail', `contact` = '$sMobile', `password` = '$password', `cpassword` = '$cpassword' WHERE `patreg`.`pid` = '$pid';";
                    $result = mysqli_query($conn, $sql);
                    if (!$result) {
                        $warning = "Patient Updation Unsuccesfull try again";
                    }
                }
            }

            if ($email == $sEmail) {
                $sql = "UPDATE `patreg` SET `fname` = '$sFName', `lname` = '$sLName', `gender` = '$sGender', `email` = '$sEmail', `contact` = '$sMobile', `password` = '$password', `cpassword` = '$cpassword' WHERE `patreg`.`pid` = '$pid';";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    $warning = "Patient Updation Unsuccesfull try again";
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

        font {
            width: 100%;
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
        }

        input[type=radio] {
            width: fit-content;
            margin: none;
        }

        .submit_btn {
            width: 90%;
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
            width: 100%;
            border: none;
            background-color: blue;
            color: white;
            padding: 7px;
        }

        .back_btn {
            text-decoration: none;
            width: 100%;
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

        @media only screen and (max-width: 500px) {
            .container {
                width: 95%;
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
                width: 100%;
            }

            body {
                height: 125vh;
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
                    <h3>Patient Updation Succesfull </h3>
                </div>
                <div class="submit_btn" style="width: 100%;">
                    <a href="adminsample.php" class="back_btn">Click to continue</a>
                </div>
            <?
            }

            if (!$result) {
                ?>
                <div class="formheader">
                    <h3>Patient Updation</h3>
                    <?
                    if (isset($warning)) {
                        echo "<p>&nbsp;<font color='red'><b>" . $warning . "</b></font></p>";
                    }
                    if (isset($same_email)) {
                        echo "<p>&nbsp;<font color='red'><b>" . $same_email . "</b></font></p>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post">
                        <input type="hidden" name="pid" value="<?= $pid ?>">
                        <label for="vFName"><b>First name</b></label>
                        <input type="text" placeholder="Enter First name" name="vFName" id="vFName" value="<?= $fname ?>"
                            required pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vLName"><b>Last name</b></label>
                        <input type="text" placeholder="Enter last name" name="vLName" id="vLName" value="<?= $lname ?>"
                            required pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vGender"><b>Gender</b></label>
                        <div class="gender">
                            <input type="radio" name="vGender" id="Male" required value="Male" <? if ($gender == "Male") {
                                echo "checked";
                            } ?>>
                            <label for="Male">Male</label>
                            <input type="radio" name="vGender" id="Female" required value="Female" <? if ($gender == "Female") {
                                echo "checked";
                            } ?>>
                            <label for="Female">Female</label>
                        </div>

                        <label for="vEmail"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="vEmail" id="vEmail" value="<?= $email ?>"
                            required>

                        <label for="vMobile"><b>Mobile</b></label>
                        <input type="number" placeholder="Enter mobile number" name="vMobile" id="vMobile"
                            value="<?= $mobile ?>" required pattern="[0-9]{10}" title="Only 10 digit numbers are allowed">

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="vPassword" id="psw"
                            value="<?= $rpassword ?>" required>

                        <label for="psw-repeat"><b>Repeat Password</b></label>
                        <input type="password" placeholder="Repeat Password" name="vCPassword" id="psw-repeat"
                            value="<?= $rcpassword ?>" required>
                        <div class="submit_btn">
                            <button class="btn" type="submit" name="patient_updation">Update</button>
                        </div>
                        <div class="submit_btn">
                            <a href="adminsample.php" class="back_btn">Back</a>
                        </div>
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
    </script>
</body>

</html>