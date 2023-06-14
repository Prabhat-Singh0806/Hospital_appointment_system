<?php
include 'session.php';
// session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
//     header("location:doctorlogin.php");
//     exit();
// }
include 'dbconfig.php';
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainstyle.css" type="text/css">
    <title>Document</title>
    <style>

    </style>
</head>

<body class="doctorbackground">

    <?php
    require("navbar.php")
        ?>


    <div class="bodybackground">
        <div>
            <div class="himg">
                <img src="image/person-circle.svg">&nbsp;&nbsp;
                <? echo "<b>Doctor " . $_SESSION['$doctorusername'] . "</b>"; ?>
            </div>
            <hr><br>
            <div class="containerdoctor">
                <div class="menu">
                    <div class="menubox">
                        <div class="doctoroption">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
                                <button type="submit" class="patientbutton" name="form1">
                                    <img src="image/doctor_appointment.png" class="imagesize">
                                    <b>
                                        <p>View appointment</p>
                                    </b></button>
                            </form>
                        </div>
                        <div class="doctoroption">
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2">
                                <button type="submit" class="patientbutton" name="form2">
                                    <img src="image/doctor_prescribe.png" class="imagesize">
                                    <b>
                                        <p>View Prescriptions</p>
                                    </b></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="showpane">
                    <?
                    if (isset($_POST['form2'])) {
                        require_once 'doctor_function.php';
                        $doctorusername = $_SESSION['$doctorusername'];
                        $obj = new doctor;
                        $obj->view_doctor_prescription($doctorusername, $searchpatientdoctor);
                    }
                    if (isset($_POST['search_patient_doctor'])) {
                        require_once 'doctor_function.php';
                        $doctorusername = $_SESSION['$doctorusername'];
                        $searchpatientdoctor = $_REQUEST['searchpatientdoctor'];
                        $obj = new doctor;
                        $obj->view_doctor_prescription($doctorusername, $searchpatientdoctor);
                    }
                    if (isset($_POST['form1'])) {
                        require_once 'doctor_function.php';
                        $doctorusername = $_SESSION['$doctorusername'];
                        $obj = new doctor;
                        $obj->view_doctor_appointment($doctorusername, $searchpatientdoctorappoint);
                    }
                    if (isset($_POST['search_patient_doctor_appoint'])) {
                        require_once 'doctor_function.php';
                        $doctorusername = $_SESSION['$doctorusername'];
                        $searchpatientdoctorappoint = $_REQUEST['searchpatientdoctorappoint'];
                        $obj = new doctor;
                        $obj->view_doctor_appointment($doctorusername, $searchpatientdoctorappoint);
                    }
                    if (isset($_POST['cancelappointment'])) {
                        require_once 'doctor_function.php';
                        // echo "succes";
                        try {
                            $id = $_REQUEST['id_app'];
                        } catch (Exception $e) {

                        }

                        $obj = new doctor;
                        $obj->cancel_appointment_doctor($id);
                        if ($obj == true) {
                            $id = 0;
                            $doctorusername = $_SESSION['$doctorusername'];
                            $obj = new doctor;
                            $obj->view_doctor_appointment($doctorusername, $searchpatientdoctorappoint);
                        }
                    }

                    ?>

                </div>
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