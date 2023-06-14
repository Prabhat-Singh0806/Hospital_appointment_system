<?php
include 'session.php';
class doctor
{
    public function view_doctor_prescription($doctorusername, $searchpatientdoctor)
    {
        try {
            include 'dbconfig.php';
            ?>
            <div style="
                            height: 10vh;
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            align-items: center;
                        ">
                <form action="" method="post">
                    <input type="search" class="searchbox" name="searchpatientdoctor" id="searchpatient"
                        placeholder="Enter Patient name" required="">
                    <button type="submit" class="searchbtn" name="search_patient_doctor">Search</button>
                </form>
            </div>
            <table>
                <tr>
                    <th>Doctor name</th>
                    <th>Patient ID</th>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Appoitmet Date</th>
                    <th>Appoitmet Time</th>
                    <th>Disease</th>
                    <th>Allergy</th>
                    <th>Prescription</th>
                </tr>
                <?
                if ($searchpatientdoctor) {
                    $sql = "SELECT * FROM `prestb` WHERE doctor = '$doctorusername' AND fname = '$searchpatientdoctor'";
                } else {
                    $sql = "SELECT * FROM `prestb` WHERE doctor = '" . $doctorusername . "' ORDER BY `prestb`.`appdate` DESC ";
                }
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
                }
                while ($num = mysqli_fetch_assoc($result)) {
                    $doctorname = $num['doctor'];
                    $patientid = $num['pid'];
                    $appid = $num['ID'];
                    $patietfname = $num['fname'];
                    $patietlname = $num['lname'];
                    $appdate = $num['appdate'];
                    $apptime = $num['apptime'];
                    $disease = $num['disease'];
                    $allergy = $num['allergy'];
                    $prescription = $num['prescription'];
                    ?>
                    <tr>
                        <td>
                            <?= $doctorname ?>
                        </td>
                        <td>
                            <?= $patientid ?>
                        </td>
                        <td>
                            <?= $appid ?>
                        </td>
                        <td>
                            <?= $patietfname ?>&nbsp;
                            <?= $patietlname ?>
                        </td>
                        <td>
                            <?= $appdate ?>
                        </td>
                        <td>
                            <?= $apptime ?>
                        </td>
                        <td>
                            <?= $disease ?>
                        </td>
                        <td>
                            <?= $allergy ?>
                        </td>
                        <td>
                            <?= $prescription ?>
                        </td>
                    </tr>
                <? } ?>
            </table>
            <?



            return true;
        } catch (Exception $e) {

        }
    }

    public function view_doctor_appointment($doctorusername, $searchpatientdoctorappoint)
    {
        try {
            include 'dbconfig.php';
            ?>
            <div style="
                            height: 10vh;
                            display: flex;
                            flex-wrap: wrap;
                            justify-content: center;
                            align-items: center;
                        ">
                <form action="" method="post">
                    <input type="search" class="searchbox" name="searchpatientdoctorappoint" id="searchpatient"
                        placeholder="Enter Patient name" required="">
                    <button type="submit" class="searchbtn" name="search_patient_doctor_appoint">Search</button>
                </form>
            </div>
            <table>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>appointment date</th>
                    <th>Appointment time</th>
                    <th>User Status</th>
                    <th>prescribe</th>
                    <th>cancel</th>
                </tr>
                <? if ($searchpatientdoctorappoint) {
                    $sql = "SELECT * FROM `appointmenttb` WHERE doctor = '$doctorusername' AND fname = '$searchpatientdoctorappoint'";
                } else {
                    $sql = "SELECT * FROM `appointmenttb` WHERE doctor = '" . $doctorusername . "' ORDER BY `appointmenttb`.`appdate` DESC ";
                }
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
                }
                $val = mysqli_num_rows($result);
                if ($val == 0) {
                    echo "already existing username";

                }
                while ($num = mysqli_fetch_assoc($result)) {
                    $pid = $num['pid'];
                    $id = $num['ID'];
                    $fname = $num['fname'];
                    $lname = $num['lname'];
                    $gender = $num['gender'];
                    $email = $num['email'];
                    $mobile = $num['contact'];
                    $doctor = $num['doctor'];
                    $docfee = $num['docFees'];
                    $appdate = $num['appdate'];
                    $apptime = $num['apptime'];
                    $userstatus = $num['userStatus'];
                    $doctorstatus = $num['doctorStatus'];


                    ?>
                    <tr>
                        <td>
                            <?= $pid ?>
                        </td>
                        <td>
                            <?= $fname ?>&nbsp;
                            <?= $lname ?>
                        </td>

                        <td>
                            <?= $gender ?>
                        </td>
                        <td>
                            <?= $email ?>
                        </td>
                        <td>
                            <?= $mobile ?>
                        </td>
                        <td>
                            <?= $appdate ?>
                        </td>
                        <td>
                            <?= $apptime ?>
                        </td>
                        <?
                        if ($userstatus == 2) { ?>
                            <td>
                                <font color="blue"><b>Prescribed</b></font>
                            </td>
                            <td>
                                <font color="blue"><b>Prescribed</b></font>
                            </td>
                            <td>
                                <form action="cancel.php.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Cancelled</button></form>
                            </td>
                        <?
                        }
                        if ($userstatus == 1 && $doctorstatus == 1) { ?>
                            <td>
                                <font color="green"><b>Active</b></font>
                            </td>
                            <td><a href="prescribe.php?id=<?= $id ?>&doctor=<?= $doctor ?>" class="prescribe">Prescribe</a></td>
                            <td>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="cancelappointment"><input type=hidden
                                        value="<?= $id ?>" name="id_app"><button type="submit" name="cancelappointment"
                                        class="cancel">Cancel</button></form>
                            </td>

                        <?
                        }
                        if ($doctorstatus == 0 && $userstatus == 1) { ?>
                            <td>
                                <font color="green"><b>Active</b></font>
                            </td>
                            <td>
                                <form action="prescribe.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Prescribe</button></form>
                            </td>
                            <td>
                                <form action="cancel.php.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>cancelled</button></form>
                            </td>
                        <? }
                        if ($doctorstatus == 1 && $userstatus == 0) { ?>
                            <td>
                                <font color="red"><b>Cancelled</b></font>
                            </td>
                            <td>
                                <form action="prescribe.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Prescribe</button></form>
                            </td>

                            <td>
                                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="cancelappointment"><input type=hidden
                                        value="<?= $id ?>" name="id_app"><button type="submit" name="cancelappointment"
                                        class="cancel">Cancel</button></form>
                            </td>

                        <? }
                        ?>
                        <?

                        if ($userstatus == 0 && $doctorstatus == 0) { ?>
                            <td>
                                <font color="red"><b>Cancelled</b></font>
                            </td>
                            <td>
                                <form action="prescribe.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Prescribe</button></form>
                            </td>
                            <td>
                                <form action="cancel.php.php" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Cancelled</button></form>
                            </td>
                        <?
                        }
                        ?>
                    </tr>
                <? } ?>
            </table>

            <?
            return true;
        } catch (Exception $e) {

        }
    }
    public function cancel_appointment_doctor($id)
    {

        include 'dbconfig.php';
        $sql = "UPDATE `appointmenttb` SET `doctorStatus` = '0' WHERE `appointmenttb`.`ID` = '$id';";
        $result = mysqli_query($conn, $sql);
        if (!$result) //checking for succesfuull insertion
        {
            echo "appointment not cancelled";
            return false;
        } else {
            return true;
        }

    }
}



?>