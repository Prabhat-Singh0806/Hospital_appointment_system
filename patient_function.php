<?php
include 'session.php';
class patient
{
    public function view_patient_prescription($patientusername)
    {
        try {
            include 'dbconfig.php';
            $sql = "SELECT * FROM `prestb` WHERE pid = '" . $patientusername . "' ORDER BY `prestb`.`ID` DESC ";
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
                <div class="patienttable">
                    <div class="patientdatabox prescriptionbox1">
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Doctor name</p>
                            </div>
                            <div class="data">
                                <?= $doctorname ?>
                            </div>
                        </div>
                        <!--
                                    <div class="patientdata">
                                        <div class="dataheading">
                                            <p>Patient ID</p>
                                        </div>
                                        <div class="data">
                                        <?= $patientid ?>
                                        </div>
                                    </div>
                                    -->
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment ID</p>
                            </div>
                            <div class="data">
                                <?= $appid ?>
                            </div>
                        </div>
                        <!--
                                    <div class="patientdata">
                                        <div class="dataheading">
                                            <p>Patient Name</p>
                                        </div>
                                        <div class="data">
                                        <?= $patietfname ?>&nbsp;<?= $patietlname ?>
                                        </div>
                                    </div>
                                    -->
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment Date</p>
                            </div>
                            <div class="data">
                                <?= $appdate ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment Time</p>
                            </div>
                            <div class="data">
                                <?= $apptime ?>
                            </div>
                        </div>
                    </div>
                    <div class="prescriptionbox2">
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Disease</p>
                            </div>
                            <div class="data">
                                <?= $disease ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Allergy</p>
                            </div>
                            <div class="data">
                                <?= $allergy ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Prescription</p>
                            </div>
                            <div class="data">
                                <?= $prescription ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Bill</p>
                            </div>
                            <div class="data">
                                <form action="invoice.php" method="post">
                                    <input type="hidden" name="doctorname" value="<?= $doctorname ?>">
                                    <input type="hidden" name="patiendid" value="<?= $patientid ?>">
                                    <input type="hidden" name="appoinmentid" value="<?= $appid ?>">
                                    <button type="submit" class="view_bill">View bill and prescription</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            <? } ?>


            <?

            return true;
        } catch (Exception $e) {

        }
    }



    public function view_patient_appointment($patientusername)
    {
        try {
            include 'dbconfig.php';
            $sql = "SELECT * FROM `appointmenttb` WHERE email = '" . $patientusername . "' ORDER BY `appointmenttb`.`ID` DESC ";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo -1;
            }
            $count = 1;
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

                <div class="patienttable" id="<?= $id ?>">
                    <div class="patientdatabox">
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment<br>Id</p>
                            </div>
                            <div class="data">
                                <b>
                                    <font color='chocolate'>
                                        <?= $id ?>
                                    </font>
                                </b>
                            </div>
                        </div>
                        <!--
                                        <div class="patientdata">
                                            <div class="dataheading">
                                                <p>Patient Id</p>
                                            </div>
                                            <div class="data">
                                                <?= $pid ?>
                                            </div>
                                        </div>
                                        <div class="patientdata">
                                            <div class="dataheading">
                                                <p>Patient Name</p>
                                            </div>
                                            <div class="data">
                                                <?= $fname ?>&nbsp;
                                                <?= $lname ?>
                                            </div>
                                        </div>
                                        <div class="patientdata">
                                            <div class="dataheading">
                                                <p>Gender</p>
                                            </div>
                                            <div class="data">
                                                <?= $gender ?>
                                            </div>
                                        </div>
                                        <div class="patientdata">
                                            <div class="dataheading">
                                                <p>Email</p>
                                            </div>
                                            <div class="data">
                                                <?= $email ?>
                                            </div>
                                        </div>
                                        <div class="patientdata">
                                            <div class="dataheading">
                                                <p>Mobile</p>
                                            </div>
                                            <div class="data">
                                                <?= $mobile ?>
                                            </div>
                                        </div>
                                        -->
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Doctor Name</p>
                            </div>
                            <div class="data">
                                <?= $doctor ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Doctor fees</p>
                            </div>
                            <div class="data">
                                <?= $docfee ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment date</p>
                            </div>
                            <div class="data">
                                <?= $appdate ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Appointment time</p>
                            </div>
                            <div class="data">
                                <?= $apptime ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Doctor Status</p>
                            </div>
                            <div class="data">
                                <? switch ($doctorstatus) {
                                    case '0':
                                        echo "<font color='red'><b>Cancelled</b></font>";
                                        break;
                                    case '1':
                                        echo "<font color='#06d506'><b>Active</b></font>";
                                        break;

                                    default:
                                        echo "<font color='blue'><b>Prescribed</b></font>";
                                        break;
                                } ?>
                            </div>
                        </div>
                        <div class="patientdata">
                            <div class="dataheading">
                                <p>Your Status</p>
                            </div>
                            <div class="data">
                                <? switch ($userstatus) {
                                    case '0':
                                        echo "<font color='red'><b>Cancelled</b></font>";
                                        break;
                                    case '1':
                                        echo "<font color='#06d506'><b>Active</b></font>";
                                        break;

                                    default:
                                        echo "<font color='blue'><b>Prescribed</b></font>";
                                        break;
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="patientaction">
                        <?
                        if ($doctorstatus == 1 && $userstatus == 1) {
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="cancelappointment">
                                <input type="hidden" value="<?= $id ?>" name="id_app">
                                <button type="submit" name="cancelappointment" class="cancel">Cancel</button>
                            </form>
                        <?
                        }
                        if ($doctorstatus == 1 && $userstatus == 0) {
                            ?>
                            <form action="cancel.html" method="post">
                                <button type="submit" class="prescibe_button" disabled>Cancelled</button>
                            </form>
                        <?
                        }
                        if ($doctorstatus == 0 && $userstatus == 1) {
                            ?>
                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="cancelappointment">
                                <input type="hidden" value="<?= $id ?>" name="id_app">
                                <button type="submit" name="cancelappointment" class="cancel">Cancel</button>
                            </form>
                        <?
                        }
                        if ($doctorstatus == 0 && $userstatus == 0) {
                            ?>
                            <form action="cancel.html" method="post">
                                <button type="submit" class="prescibe_button" disabled>Cancelled</button>
                            </form>
                        <?
                        }
                        if ($doctorstatus == 2 && $userstatus == 2) {
                            ?>
                            <form action="invoice.php" method="post">
                                <input type="hidden" name="doctorname" value="<?= $doctor ?>">
                                <input type="hidden" name="patiendid" value="<?= $pid ?>">
                                <input type="hidden" name="appoinmentid" value="<?= $id ?>">
                                <button type="submit" class="view_bill">View bill and prescription</button>
                            </form>
                        <?
                        }
                        ?>
                    </div>
                </div>
                <?
                $count = $count + 1;
                if ($count == 11) {
                    break;
                }
            }

            return true;
        } catch (Exception $e) {

        }
    }

    public function cancel_appointment_patient($id)
    {

        include 'dbconfig.php';
        $sql = "UPDATE `appointmenttb` SET `userStatus` = '0' WHERE `appointmenttb`.`ID` = '$id';";
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