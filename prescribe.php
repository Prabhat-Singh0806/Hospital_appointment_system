<?php
include 'session.php';
// session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
//     header("location:loginpage.php");
//     exit();
// }
$id = $_REQUEST['id'];
$doctor = $_REQUEST['doctor'];
if (isset($_POST['prescribe'])) {
    include 'dbconfig.php';
    $disease = $_REQUEST['Disease'];
    $Allergy = $_REQUEST['Allergy'];
    $Prescription = $_REQUEST['Prescription'];
    $sql = "SELECT * FROM `appointmenttb` WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -1;
    }
    while ($num = mysqli_fetch_assoc($result)) {
        $pid = $num['pid'];
        $id = $num['ID'];
        $fname = $num['fname'];
        $lname = $num['lname'];
        $doctor = $num['doctor'];
        $appdate = $num['appdate'];
        $apptime = $num['apptime'];

        $sql = "INSERT INTO `prestb` (`doctor`, `pid`, `ID`, `fname`, `lname`, `appdate`, `apptime`, `disease`, `allergy`, `prescription`) VALUES ('$doctor', '$pid', '$id', '$fname', '$lname', '$appdate', '$apptime', '$disease', '$Allergy', '$Prescription');";
        $result = mysqli_query($conn, $sql);
        if (!$result) //checking for succesfuull insertion
        {
            echo "data not inserted";
        } else {
            $sql = "UPDATE `appointmenttb` SET `userStatus` = '2',
            `doctorStatus` = '2' WHERE `appointmenttb`.`ID` = '$id';";
            $result = mysqli_query($conn, $sql);
            if (!$result) //checking for succesfuull insertion
            {
                echo "data not inserted";
            } else {
                header("location: doctorsample.php");
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
    <title>prescribe</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            background-image: url("image/prescribe_bg1.png");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            position: absolute;
            top: 20%;
            left: 35%;
            border-radius: 12px;
        }

        .prescribe_box1 {
            text-align: center;
            margin: -40px -17px;
            padding: 29px 94px;
        }

        .prescription_form {
            display: grid;
            grid-template-rows: 3;
            grid-template-columns: 1fr 2fr;
            padding: 10px 10px;
        }

        .item1 {
            padding: 50px 10px;
            text-align: center;
        }

        .item1 label {
            font-size: 20px;
        }

        .item2 {
            grid-column: 2;
            padding: 0px 10px;
        }

        .item2 textarea {
            display: block;
            width: 100%;
            height: 60%;
            padding: 8px;
            border: 1px solid black;
            border-radius: 5px;
            font-family: 'Lucida Sans Unicode';
            font-size: 16px;
            resize: none;
            margin-top: 14px;
            background-color: transparent;
            outline: none;
        }

        .submit_prescription {
            display: grid;
            width: 85%;
            grid-template-columns: 2fr 2fr 2fr;
            padding: 7px -12px;
            margin: 13px 74px;
        }

        .back {
            grid-column: 1;
        }

        .submit {
            grid-column: 2;
        }

        .reset {
            grid-column: 3;
        }

        .prescription_buttons {
            display: block;
            padding: 8px 3px;
            color: black;
            text-align: center;
            width: 60%;
            text-decoration: none;
            border-radius: 5px;
            border: 3px solid blue;
        }

        .prescription_buttons:hover {
            color: white;
            cursor: pointer;
            background-color: blue;
        }

        .prs_sub_btn {
            border: 3px solid green;
            padding: 9px 1px;
        }

        .prs_sub_btn:hover {
            color: white;
            cursor: pointer;
            background-color: rgb(22, 214, 22);
        }

        .prs_res_btn {
            border: 3px solid red;
        }

        .prs_res_btn:hover {
            color: white;
            cursor: pointer;
            background-color: red;
        }

        img {
            width: 40px;
            height: 40px;
        }

        .row {
            display: grid;
        }

        .col1 {
            grid-column: 1;
            margin: 2px 9px;
        }

        .col2 {
            grid-column: 2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="prescribe_box1 row">
            <div class="col1"><img src="image/prescription.png" alt="" srcset=""></div>
            <div class="col2">
                <h1><u>Prescription page</u></h1>
            </div>
        </div>
        <div class="prescription_form">
            <div class="item1">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?= $id ?>&doctor=<?= $doctor ?>" method="post"
                    name="prescribe">
                    <label for="Disease">Disease</label>
            </div>
            <div class="item2">
                <textarea name="Disease" id="Disease" required></textarea>
            </div>
            <div class="item1">
                <label for="Allergy">Allergy</label>
            </div>
            <div class="item2">
                <textarea name="Allergy" id="Allergy" required></textarea>
            </div>
            <div class="item1">
                <label for="Prescription">Prescription</label>
            </div>
            <div class="item2">
                <textarea name="Prescription" id="Prescription" required></textarea>
            </div>
        </div>
        <div class="submit_prescription">
            <div class="back">
                <button type="reset" class="prescription_buttons prs_res_btn">Reset</button>
                <!-- <form action="doctorsample.php" method="post"><button type="submit"
                        class="prescription_buttons">back</button></form> -->
            </div>
            <div class="submit"><button type="submit" class="prescription_buttons prs_sub_btn"
                    name="prescribe">Prescribe</button></div>
            </form>
            <div class="reset">
                <form action="doctorsample.php" method="post"><button type="submit"
                        class="prescription_buttons">back</button></form>
            </div>

        </div>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>