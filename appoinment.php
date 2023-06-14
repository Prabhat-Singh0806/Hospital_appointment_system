<?
include 'session.php';
$pid = $_REQUEST['pid'];
$admin = $_REQUEST['admin'];
$date = date("Y-m-d");
$enddate = date('Y-m-d', strtotime($date . '+ 7 days'));
// echo $pid;
include 'dbconfig.php';

if (isset($_POST['book_appointment'])) {
    $dept = $_REQUEST['department'];
    $doctor = $_REQUEST['Doctors'];
    $docFees = $_REQUEST['Consultancy_Fees'];
    $appdate = $_REQUEST['appdate'];
    $apptime = $_REQUEST['apptime'];
    $apptime = $apptime . ":00";
    // echo $docFees;
    // echo $apptime;
    if (empty($dept) || empty($doctor)) {
        $message = "&#9888; Department or Doctor not Selected";

    } else {
        $sql = "SELECT * FROM `patreg` WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
        while ($num = mysqli_fetch_assoc($result)) {
            // $pid=$num['pid'];
            $fname = $num['fname'];
            $lname = $num['lname'];
            $gender = $num['gender'];
            $email = $num['email'];
            $mobile = $num['contact'];
        }

        $sql = "INSERT INTO `appointmenttb` (`pid`, `ID`, `fname`, `lname`, `gender`, `email`, `contact`, `doctor`, `docFees`, `appdate`, `apptime`, `userStatus`, `doctorStatus`) VALUES ('$pid', NULL, '$fname', '$lname', '$gender', '$email', '$mobile', '$doctor', '$docFees', '$appdate', '$apptime', '1', '1');";

        $result = mysqli_query($conn, $sql);
    }




} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainstyle.css" type="text/css">
    <link rel="stylesheet" href="css/responsive.css">
    <title>Document</title>
    <style>

    </style>
</head>

<body>

    <div class="showpaneflex book_appointment_main_container">
        <?
        if ($admin > 0 && $result) { ?>
            <div class="patienttable book_appointment_second_container">
                <b>
                    <h2>
                        <center>Appointment has been scheduled Succesfully</center>
                    </h2>
                </b><br><br>
                <form action="adminsample.php" method="post" id="go">
                    <center>
                        <button type="submit" class="book_appointment_btn ok_btn">OK</button>
                    </center>
                </form>
            </div>
        <? }
        if ($result && $admin < 1) { ?>
            <div class="patienttable book_appointment_second_container">
                <b>
                    <h2>
                        <center>Appointment has been scheduled Succesfully</center>
                    </h2>
                </b><br>
                <form action="patientsample.php" method="post" id="go">
                    <center>
                        <button type="submit" class="book_appointment_btn ok_btn" name="booked">OK</button>
                    </center>
                </form>
            </div>
        <? }
        if (!$result) {
            ?>
            <div class="patienttable book_appointment_second_container">
                <b> Book Appointment</b>
                <?
                if (isset($message)) {
                    ?>
                    <div class="warning">
                        <? echo $message; ?>
                    </div>
                <?
                }
                ?>
            </div>

            <div class="patienttable book_appointment_second_container">
                <form action="" method="post">
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <label for="Speciallization">Specialization</label>
                        </div>
                        <? if (isset($_POST['department'])) {
                            $dept = $_REQUEST['department'];
                        } ?>
                        <? if (isset($_POST['Doctors'])) {
                            $dept = $_REQUEST['department'];
                            $doctor = $_REQUEST['Doctors'];
                        } ?>
                        <div class="bookdataoption">
                            <select name="department" id="department" onchange="this.form.submit()">
                                <option value="Null" disabled selected>Departments</option>
                                <?
                                $sql = "SELECT spec FROM doctb ORDER BY spec ASC";
                                $result = mysqli_query($conn, $sql);
                                while ($num = mysqli_fetch_assoc($result)) {
                                    $spec = $num['spec'];
                                    if ($spec != $value) {
                                        ?>
                                        <option value="<?= $spec ?>" <? if ($dept == $spec) {
                                            echo "selected";
                                        } ?>>
                                            <?= $spec ?>
                                        </option>
                                    <?
                                    }
                                    $value = $spec;
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <label for="doctor">Doctor </label>
                        </div>
                        <div class="bookdataoption">
                            <select name="Doctors" id="Doctors" onchange="this.form.submit()">
                                <option value="Null" disabled selected>Doctors</option>
                                <?
                                $sql = "SELECT username FROM doctb WHERE spec = '$dept'";
                                $result = mysqli_query($conn, $sql);
                                while ($num = mysqli_fetch_assoc($result)) {
                                    $docname = $num['username'];
                                    ?>
                                    <option value="<?= $docname ?>" <? if ($doctor == $docname) {
                                        echo "selected";
                                    } ?>>
                                        <?= $docname ?>
                                    </option>
                                <?
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <label for="Consultancy_Fees">Consultancy Fees</label>
                        </div>
                        <div class="bookdataoption">
                            <?
                            $sql = "SELECT docFees FROM doctb WHERE username = '$doctor'";
                            $result = mysqli_query($conn, $sql);
                            while ($num = mysqli_fetch_assoc($result)) {
                                $consultancy_fees = $num['docFees'];
                            }
                            ?>
                            <input type="text" name="Consultancy_Fees" id="Consultancy_Fees" value="<?= $consultancy_fees ?>"
                                disabled>
                            <input type="hidden" name="Consultancy_Fees" id="Consultancy_Fees"
                                value="<?= $consultancy_fees ?>">
                        </div>
                    </div>
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <label for="appdate">Date</label>
                        </div>
                        <div class="bookdataoption">
                            <input type="date" name="appdate" id="appdate" value="<? echo $date; ?>" min="<? echo $date; ?>"
                                max="<? echo $enddate; ?>" required>
                        </div>
                    </div>
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <label for="apptime">Time</label>
                            <p style="font-size: 13px; color: #a5a1a1;">(Select Time Between 10 am and 17pm)</p>
                        </div>
                        <div class="bookdataoption">
                            <input type="time" name="apptime" id="apptime" min="10:00" max="17:00"
                                title="select time between 10am to 5pm" required>
                        </div>
                    </div>
                    <div class="bookdata">
                        <div class="bookdataheading">
                            <center>
                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                <input type="hidden" name="admin" value="<?= $admin ?>">
                                <button type="submit" name="book_appointment" class="book_appointment_btn">Book
                                    Appoinment</button>
                            </center>
                        </div>
                </form>
                <div class="bookdataoption" style="border:none;" id="go_back_btn">
                    <form action="<?
                    if ($admin > 0) {
                        echo " adminsample.php";
                    }
                    if ($admin < 1) {
                        echo "patientsample.php";
                    } ?>"
                        method="post">
                        <center>
                            <button type="submit" class="go_back_btn">Back</button>
                        </center>
                    </form>
                </div>
            </div>
        </div>
    <? } ?>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>