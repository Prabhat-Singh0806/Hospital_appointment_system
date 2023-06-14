<?php
include 'session.php';
// session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
//   header("location:loginpage.php");
//   exit();
// }

include 'dbconfig.php';
$id = $_REQUEST['id_app'];
echo $id;
// $sql = "UPDATE `myhmsdb`.`appointmenttb` SET `doctorStatus` = '0' WHERE `appointmenttb`.`ID` = '$id';";
// $result = mysqli_query($conn, $sql);

//     if (!$result) //checking for succesfuull insertion
//     {
//         echo "appointment not cancelled";

//     } else {
$sql = "UPDATE `appointmenttb` SET `userStatus` = '0', `doctorStatus` = '0' WHERE `appointmenttb`.`ID` = '$id';";
$result = mysqli_query($conn, $sql);
if (!$result) //checking for succesfuull insertion
{
    echo "appointment not cancelled use";

} else { ?>
    <a href="adminsample.php">OK</a>
<?
}

// }





?>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>