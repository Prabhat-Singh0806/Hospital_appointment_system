<?php
include 'session.php';
// session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
//   header("location:adminlogin.php");
//   exit();
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

<body class="adminbackgound">



  <div class="bodybackground">
    <?php
    require("navbar.php")
      ?>
    <div>
      <div class="adminheader">
        <div class="himg">
          <img src="image/person-circle.svg">&nbsp;&nbsp;Admin
        </div>
        <hr>
      </div>
      <div class="containeradmin">
        <div class="menu">
          <div class="menubox">
            <div class="adminoption">
              <form action="doctorregistration.php"><button type="submit" class="linkbutton"><b>Add
                    Doctor</b></button>
              </form>
            </div>
            <div class="adminoption">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1"><button type="submit"
                  name="form1" class="linkbutton"><b>view Doctor</b></button>
              </form>
            </div>
            <div class="adminoption">
              <form action="registration.php">
                <input type="hidden" value="1" name="admin">
                <button type="submit" class="linkbutton"><b>Add
                    Patient</b></button>
              </form>
            </div>
            <div class="adminoption">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2"><button type="submit"
                  name="form2" class="linkbutton"><b>view patient</b></button></form>
            </div>
            <!-- <div class="adminoption">
              <form action="#"><button type="submit" class="linkbutton"><b>Add appointment</b></button></form>
            </div> -->
            <div class="adminoption">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form3"><button type="submit"
                  name="form3" class="linkbutton"><b>View Appointment</b></button></form>
            </div>
            <div class="adminoption">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form4"><button type="submit"
                  name="form4" class="linkbutton"><b>View Queries</b></button></form>
            </div>
            <div class="adminoption">
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form5"><button type="submit"
                  name="form5" class="linkbutton"><b>View Prescriptions</b></button></form>
            </div>
          </div>
        </div>

        <div class="showpane">
          <?
          if (isset($_POST['form1'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $obj->view_admin_doctor();
          }
          if (isset($_POST['form2'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $obj->view_admin_patient($searchedpatient);
          }
          if (isset($_POST['search_patient'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $searchedpatient = $_REQUEST['searchpatient'];
            $obj->view_admin_patient($searchedpatient);
          }
          if (isset($_POST['form3'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $searched = null;
            $obj->view_admin_appointment($searched);
          }
          if (isset($_POST['search_appointment'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $searched = $_REQUEST['searchpatientappoint'];
            ;
            $obj->view_admin_appointment($searched);
          }
          if (isset($_POST['form4'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $obj->view_admin_queries();
          }
          if (isset($_POST['form5'])) {
            require_once 'admin_function.php';
            $obj = new admin;
            $obj->view_admin_prescription();
            // view_admin_prescription();
          }
          if (isset($_POST['doctor'])) {
            $reassign_doctor = $_REQUEST['doctor'];
            $reassign_id = $_REQUEST['id'];
            // echo $username;
            // echo $id;
            $sql = "UPDATE `appointmenttb` SET `doctor` = '$reassign_doctor', `doctorStatus` = '1' WHERE `appointmenttb`.`ID` = $reassign_id;";
            // echo $sql;
            $result = mysqli_query($conn, $sql);
            if (!$result) {
              echo "Reassign Unsuccesfull";
            } else {
              require_once 'admin_function.php';
              $obj = new admin;
              $obj->view_admin_appointment($searched);
            }
          }

          if (isset($_POST['cancelappointment'])) {
            require_once 'admin_function.php';
            $id_cancel = $_REQUEST['id_app'];
            $obj = new admin;
            $obj->cancel_appointment_admin($id_cancel);
            if ($obj == true) {
              $id_cancel = 0;
              $obj = new admin;
              $obj->view_admin_appointment($searched);
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