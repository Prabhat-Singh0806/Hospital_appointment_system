<?php
include 'session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['doctor_registration'])) {
        include 'dbconfig.php';

        $username = $_REQUEST['vUserName'];
        $password = $_REQUEST['vpassword'];
        $email = $_REQUEST['vEmail'];
        $spec = $_REQUEST['vspec'];
        $docfee = $_REQUEST['vfees'];

        //checking if user alredy exist
        $sql = "SELECT * FROM doctb WHERE username = '$username'"; //checking for already registered username
        $returndoctor = mysqli_query($conn, $sql);
        if (!$returndoctor) {
            echo -10;
        }
        $val = mysqli_num_rows($returndoctor);
        if ($val != 0) {
            $same = "&#9888; Already existing username";
        } else {
            $sql = "INSERT INTO `doctb` (`username`, `password`, `email`, `spec`, `docFees`) VALUES ('$username', '$password', '$email', '$spec', '$docfee');";
            $result = mysqli_query($conn, $sql);
            if (!$result) //checking for succesfuull insertion
            {
                $warning = "Doctor Registration Unsuccesfull try again";
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
                    <h3>Doctor Registration Succesfull </h3>
                </div>
                <div class="submit_btn" style="width: 100%;">
                    <a href="adminsample.php" class="back_btn">Click to continue</a>
                </div>
            <?
            }
            if (!$result) {
                ?>
                <div class="formheader">
                    <h3>Doctor Registration</h3>
                    <?
                    if (isset($same)) {
                        echo "&nbsp;<font color='red'><b>" . $same . "</b></font>";
                    }
                    if (isset($warning)) {
                        echo "&nbsp;<font color='red'><b>" . $warning . "</b></font>";
                    }
                    ?>
                </div>
                <div class="formtable">
                    <form action="" method="post">

                        <label for="vUserName"><b>Username</b></label>
                        <input type="text" placeholder=" enter username" name="vUserName" id="vUserName" required
                            pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vpassword"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="vpassword" id="vpassword" required>

                        <label for="vEmail"><b>Email</b></label>
                        <input type="email" placeholder="Enter Email" name="vEmail" id="vEmail" required>

                        <label for="vspec"><b>Specification</b></label>
                        <input type="text" placeholder="Enter specification of the doctor" name="vspec" id="vspec" required
                            pattern="[A-Za-z]{2,15}" title="Atleast 2 to 16 characters required">

                        <label for="vfees"><b>Doctor Fees</b></label>
                        <input type="number" placeholder="Enter Doctor Fees" name="vfees" id="vfees" required>

                        <div class="submit_btn">
                            <button class="btn" type="submit" name="doctor_registration">Register</button>
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