<?php
include 'session.php';
class admin
{
    public function view_admin_prescription()
    {
        try {
            include 'dbconfig.php';
            ?>
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
                $sql = "SELECT * FROM `prestb` ORDER BY `prestb`.`appdate` DESC ";
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

    public function view_admin_appointment($searched)
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
                    <input type="search" class="searchbox" name="searchpatientappoint" id="searchpatient"
                        placeholder="Enter Patient Name" required="">
                    <button type="submit" class="searchbtn" name="search_appointment">Search</button>
                </form>
            </div>
            <table>
                <!-- <thead> -->
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <!-- <th>Last name</th> -->
                    <!--   <th>Gender</th>
                    <th>Email</th>
            -->
                    <!-- <th>Mobile</th> -->
                    <th>Doctor</th>
                    <!-- <th>Doctor fees</th> -->
                    <th>appointment date</th>
                    <th>Appointment time</th>
                    <th>user Status</th>
                    <th>Doctor status</th>
                    <th>reassign</th>
                    <th>cancel</th>
                </tr>
                <!-- </thead> -->
                <?
                if ($searched) {
                    $sql = "SELECT * FROM `appointmenttb` WHERE fname = '$searched'";
                } else {
                    $sql = "SELECT * FROM `appointmenttb` ORDER BY `appointmenttb`.`appdate` DESC ";
                }
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
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
                    if ($userstatus == 1) {
                        $statususer = "Active";
                    } else {
                        $statususer = "cancelled";
                    }
                    if ($doctorstatus == 1) {
                        $statusdoctor = "Active";
                    } else {
                        $statusdoctor = "cancelled";
                    }


                    ?>
                    <tr>
                        <td>
                            <?= $pid ?>
                        </td>
                        <td>
                            <?= $fname ?>&nbsp;
                            <?= $lname ?>
                        </td>
                        <!--
                        <td>
                            <?= $gender ?>
                        </td>
                        <td>
                            <?= $email ?>
                        </td>
                -->
                        <!-- <td>
                       
                                        </td> -->
                        <td>
                            <?= $doctor ?>
                        </td>
                        <!-- <td><? //=$docfee?></td> -->
                        <td>
                            <?= $appdate ?>
                        </td>
                        <td>
                            <?= $apptime ?>
                        </td>
                        <?
                        if ($userstatus == 1) { ?>
                            <td>
                                <font color="green"><b>Active</b></font>
                            </td>
                        <?
                        } elseif ($userstatus == 2) {
                            ?>
                            <td>
                                <font color="blue"><b>Prescribed</b></font>
                            </td>
                        <?
                        } else { ?>

                            <td>
                                <font color="red"><b>Cancelled</b></font>
                            </td>
                        <?
                        }

                        if ($doctorstatus == 1) { ?>
                            <td>
                                <font color="green"><b>Active</b></font>
                            </td>
                        <?
                        } elseif ($doctorstatus == 2) {
                            ?>
                            <td>
                                <font color="blue"><b>Prescribed</b></font>
                            </td>
                        <?
                        } else { ?>
                            <td>
                                <font color="red"><b>Cancelled</b></font>
                            </td>
                        <?
                        }
                        ?>
                        <td>

                            <!-- <form action="reassign.php" method="post" name="reassign">
                                            <input type=hidden value="<? //=$id?>" name="id_app_reassign">
                                            <input type=hidden value="<? //=$doctor?>" name="doctor_app_reassign">
                                        <button type="submit" name="reassign" class="reassign_button"
                                                        >ReAssign</button></form> -->
                            <?
                            if ($userstatus == 1) {
                                reassign($id, $doctor);

                            } else { ?>
                                <form action="cancel.html" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Cancelled</button></form>
                            <?
                            }
                            ?>

                        </td>
                        <? if ($doctorstatus == 2 && $userstatus == 2) { ?>
                            <td>
                                <div>
                                    <form action="invoice.php" method="post">
                                        <input type="hidden" name="doctorname" value="<?= $doctor ?>">
                                        <input type="hidden" name="patiendid" value="<?= $pid ?>">
                                        <input type="hidden" name="appoinmentid" value="<?= $id ?>">
                                        <input type="hidden" name="adminflag" value="1">
                                        <button type="submit" class="view_bill">View Bill</button>
                                    </form>
                                </div>
                            </td>
                        <?
                        } elseif ($doctorstatus == 0 && $userstatus == 0) {

                            ?>
                            <td>
                                <form action="cancel.html" method="post"><button type="submit" class="prescibe_button"
                                        disabled>Cancelled</button></form>
                            </td>
                        <?
                        } else {
                            ?>
                            <td>
                                <form method="post" name="cancelappointment"><input type=hidden value="<?= $id ?>" name="id_app"><button
                                        type="submit" name="cancelappointment" class="cancel">Cancel</button></form>
                            </td>
                        <?
                        }
                }
                ?>
                </tr>

            </table>

            <?

            return true;
        } catch (Exception $e) {

        }
    }
    public function view_admin_patient($searchedpatient)
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
                    <input type="search" class="searchbox" name="searchpatient" id="searchpatient" placeholder="Enter Patient name"
                        required="">
                    <button type="submit" class="searchbtn" name="search_patient">Search</button>
                </form>
            </div>
            <table>
                <tr>
                    <th>Patient ID</th>
                    <th>Patient Name</th>
                    <!-- <th>Last name</th> -->
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Password</th>
                    <th>Remove</th>
                    <th>book</th>
                    <th>Edit</th>
                </tr>
                <?
                if ($searchedpatient) {
                    $sql = "SELECT * FROM `patreg` WHERE fname = '$searchedpatient'";
                } else {
                    $sql = "SELECT * FROM `patreg` ORDER BY `patreg`.`pid` DESC";
                }
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
                }
                while ($num = mysqli_fetch_assoc($result)) {
                    $pid = $num['pid'];
                    $fname = $num['fname'];
                    $lname = $num['lname'];
                    $gender = $num['gender'];
                    $email = $num['email'];
                    $mobile = $num['contact'];
                    $password = $num['password'];


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
                            <?= $password ?>
                        </td>
                        <td>
                            <form action="remove.php" method="post">
                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                <input type="hidden" name="fname" value="<?= $fname ?>">
                                <button type="submit" class="cancel">Remove</button>
                            </form>
                        </td>
                        <td>
                            <form action="appoinment.php" method="post">
                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                <input type="hidden" name="admin" value="1">
                                <button type="submit" class="view_bill"> Add Appointment</button>
                            </form>
                        </td>
                        <td>
                            <form action="updateuser.php" method="post">
                                <input type="hidden" name="pid" value="<?= $pid ?>">
                                <button type="submit" class="view_bill">Edit</button>
                            </form>
                        </td>
                    </tr>
                <? } ?>
            </table>

            <?
            return true;
        } catch (Exception $e) {

        }
    }
    public function view_admin_queries()
    {
        try {
            include 'dbconfig.php';
            ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Message</th>
                </tr>
                <?
                $sql = "SELECT * FROM `contact`";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
                }
                while ($num = mysqli_fetch_assoc($result)) {
                    $name = $num['name'];
                    $email = $num['email'];
                    $contact = $num['contact'];
                    $message = $num['message'];
                    ?>
                    <tr>
                        <td>
                            <?= $name ?>
                        </td>
                        <td>
                            <?= $email ?>
                        </td>
                        <td>
                            <?= $contact ?>
                        </td>
                        <td>
                            <?= $message ?>
                        </td>
                    </tr>
                <? } ?>
            </table>

            <?

            return true;
        } catch (Exception $e) {

        }
    }
    public function view_admin_doctor()
    {
        try {
            include 'dbconfig.php';
            ?>
            <table>
                <tr>
                    <th>Usernsme</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Specification</th>
                    <th>Fees</th>
                    <th>Remove</th>
                    <th>Edit</th>
                </tr>
                <?
                $sql = "SELECT * FROM `doctb`";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    echo -1;
                }
                while ($num = mysqli_fetch_assoc($result)) {
                    $username = $num['username'];
                    $password = $num['password'];
                    $email = $num['email'];
                    $spec = $num['spec'];
                    $docfee = $num['docFees'];
                    ?>
                    <tr>
                        <td>
                            <?= $username ?>
                        </td>
                        <td>
                            <?= $password ?>
                        </td>
                        <td>
                            <?= $email ?>
                        </td>
                        <td>
                            <?= $spec ?>
                        </td>
                        <td>
                            <?= $docfee ?>
                        </td>
                        <td>
                            <form action="remove.php" method="post">
                                <input type="hidden" name="email" value="<?= $email ?>">
                                <input type="hidden" name="username" value="Dr. <?= $username ?>">
                                <button type="submit" class="cancel">Remove</button>
                            </form>
                        </td>
                        <td>
                            <form action="updatedoctor.php" method="post">
                                <input type="hidden" name="username" value="<?= $username ?>">
                                <button type="submit" class="view_bill">Edit</button>
                            </form>
                        </td>
                    </tr>
                <? } ?>
            </table>

            <?

            return true;
        } catch (Exception $e) {

        }
    }

    public function cancel_appointment_admin($id_cancel)
    {
        include 'dbconfig.php';
        // $id = $_REQUEST['id_app'];
        $sql = "UPDATE `appointmenttb` SET `userStatus` = '0', `doctorStatus` = '0' WHERE `appointmenttb`.`ID` = '$id_cancel';";
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

function reassign($id, $doctor)
{
    include 'dbconfig.php';
    // $id = $_REQUEST['id_app_reassign'];
    // $doctor = $_REQUEST['doctor_app_reassign'];
    $sql = "SELECT * FROM doctb WHERE username = '$doctor'"; //checking for already registered username
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -10;
    }
    while ($num = mysqli_fetch_assoc($result)) {
        $spec = $num['spec'];
        // echo $spec;
    }
    $sql = "SELECT username FROM doctb WHERE spec = '$spec'";
    // echo $sql; //
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        echo -10;
    }
    ?>
    <form method="post" name="reassign_func">
        <select name="doctor" id="doctor" onchange="this.form.submit()" class="reassign_button">
            <option value="null" disabled selected>Change</option>
            <? while ($num = mysqli_fetch_assoc($result)) {
                $username = $num['username'];
                // echo $username;
                ?>
                <option value="<?= $username ?>">
                    <?= $username ?>
                </option>
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
}

?>