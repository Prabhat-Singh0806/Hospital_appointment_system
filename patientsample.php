<?php

include 'session.php';
include 'dbconfig.php';
$sql = "SELECT * FROM patreg WHERE email = '" . $_SESSION['$username'] . "';";
$result = mysqli_query($conn, $sql);
if (!$result) {
  echo -1;
}
while ($num = mysqli_fetch_assoc($result)) {
  $pid = $num['pid'];
  $fname = $num['fname']; //to display the name in dashboard
  $lname = $num['lname'];
}
?>

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
    .linkbutton {
      border-radius: 7px;
    }

    @media only screen and (max-width: 500px) .view {
      width: 98%;
    }

    .himg {
      height: 10vh;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
    }

    .himg img {
      width: 30px;
      height: 30px;
    }
  </style>
</head>

<body id="patientbody">

  <?php
  require("navbar.php")
    ?>



  <div class="heading">
    <div class="himg">
      <img src="image/person-circle.svg">&nbsp;&nbsp;
      <? echo "<b>" . $fname . "  " . $lname . "</b>"; ?>
    </div>
    <hr><br>
  </div>
  <div class="flexcontainer">
    <div class="menupatient">
      <div class="view">
        <form action="view_profile.php?pid=<?= $pid ?>" method="post">
          <button type="submit" class="linkbutton" name="view_pro">
            <b>
              <p>View Profile</p>
            </b></button>
        </form>
      </div>
      <div class="bookappointment imgborder">
        <form action="appoinment.php?pid=<?= $pid ?>" method="post">
          <button type="submit" class="patientbutton"><img src="image/appointment.png" class="imagesize">
            <b>
              <p>Book appointment</p>
            </b></button>
        </form>
      </div>
      <div class="appointmenthistory imgborder">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form1"><button type="submit" name="form1"
            class="patientbutton">
            <img src="image/calendar.png" class="imagesize"><b>
              <p>Appointment history</p>
            </b></button>
        </form>
      </div>
      <div class="viewprescription imgborder">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="form2"><button type="submit" name="form2"
            class="patientbutton"><img src="image/viewpres.png" class="imagesize">
            <b>
              <p>My Prescriptions</p>
            </b></button>
        </form>
      </div>
    </div>

    <!-- <div class="divider"></div> -->
    <div class="showpaneflex" id="show">
      <?
      if (isset($_POST['form2'])) {
        require_once 'patient_function.php';
        $patientusername = $pid;
        $obj = new patient;
        $obj->view_patient_prescription($patientusername); //calling method from patientfunction.php though object of patient class
        ?>
        <script> const element = document.getElementById('show'); element.scrollIntoView(); </script>
      <?
      }
      if (isset($_POST['form1'])) {
        require_once 'patient_function.php';
        $patientusername = $_SESSION['$username'];
        $obj = new patient;
        $obj->view_patient_appointment($patientusername);
        ?>
        <script> const element = document.getElementById('show'); element.scrollIntoView(); </script>
      <?
      }
      if (isset($_POST['booked'])) {
        require_once 'patient_function.php';
        $patientusername = $_SESSION['$username'];
        $obj = new patient;
        $obj->view_patient_appointment($patientusername);
        ?>
        <script> const element = document.getElementById('show'); element.scrollIntoView(); </script>
      <?
      }
      if (isset($_POST['cancelappointment'])) {
        require_once 'patient_function.php';
        // echo "succes";
        try {
          $id = $_REQUEST['id_app'];
        } catch (Exception $e) {

        }

        $obj = new patient;
        $obj->cancel_appointment_patient($id);
        if ($obj == true) {

          $patientusername = $_SESSION['$username'];
          $obj = new patient;
          $obj->view_patient_appointment($patientusername);
          ?>
          <script>
            var x = "<? echo $id; ?>";
            const element = document.getElementById(x); element.scrollIntoView(); </script>
          <?
          $id = 0;
        }
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