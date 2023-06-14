<?php
include 'session.php';
// session_start();
// if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
//   header("location:loginpage.php");
//   exit();
// }

include 'dbconfig.php';
$id = $_REQUEST['id_app_reassign'];
$doctor = $_REQUEST['doctor_app_reassign'];
echo $id;
echo $doctor;
$sql = "SELECT * FROM doctb WHERE username = '$doctor'"; //checking for already registered username
$result = mysqli_query($conn, $sql);
if (!$result) {
  echo -10;
}
while ($num = mysqli_fetch_assoc($result)) {
  $spec = $num['spec'];
  echo $spec;
}
$sql = "SELECT username FROM doctb WHERE spec = '$spec'";
echo $sql; //
$result = mysqli_query($conn, $sql);
if (!$result) {
  echo -10;
}
?>
<form action="adminsample.php?" method="post" name="reassign_func">
  <select name="doctor" id="doctor" onchange="this.form.submit()">
    <? while ($num = mysqli_fetch_assoc($result)) {
      $username = $num['username'];
      echo $username; ?>
      <option value="<?= $username ?>"><?= $username ?></option>
    <?
    }
    ?>
    <!-- <option value="2">doctor2</option>
        <option value="3">doctor3</option> -->
  </select>
  <input type="hidden" name="id" value="<?= $id ?>">
  <!-- <button type="submit">submit</button> -->
</form>
<?
// if (isset($_POST['reassign'])) {
//     $sql = "UPDATE `myhmsdb`.`appointmenttb` SET `doctor` = '$username' WHERE `appointmenttb`.`ID` = $id;";
//     echo $sql;
//     $result = mysqli_query($conn, $sql);
//     if (!$result) {
//       echo "not done";
//     }
//     else {
//         echo "done";
//     }
// }






?>
<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>