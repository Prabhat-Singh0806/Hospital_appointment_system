<?
include 'session.php';
include 'dbconfig.php';
$adminflag = $_REQUEST['adminflag'];
$doctorname = $_REQUEST['doctorname'];
$patientid = $_REQUEST['patiendid'];
$appointmentid = $_REQUEST['appoinmentid'];
$sql = "SELECT * FROM patreg WHERE pid = '$patientid'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "-10";
}
$valpatient = mysqli_num_rows($result);
if (!$valpatient) {
    exit();
} else {
    while ($num = mysqli_fetch_assoc($result)) {
        $fname = $num['fname'];
        $lname = $num['lname'];
        $gender = $num['gender'];
        $email = $num['email'];
        $contact = $num['contact'];
    }
}

$sql = "SELECT* FROM doctb WHERE username = '$doctorname'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "-10";
}
$valdoctor = mysqli_num_rows($result);
if (!$valdoctor) {
    $doctorname = "Unknown";
    $doctorspec = "Unknown";
    $doctoremail = "Unknown";
    $doctorfees = "Unknown";
} else {
    while ($num = mysqli_fetch_assoc($result)) {
        $doctorname = $num['username'];
        $doctorspec = $num['spec'];
        $doctoremail = $num['email'];
        $doctorfees = $num['docFees'];
    }
}

$sql = "SELECT * FROM prestb WHERE ID = '$appointmentid'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "-10";
}
$valpres = mysqli_num_rows($result);
if (!$valpres) {
    exit();
} else {
    while ($num = mysqli_fetch_assoc($result)) {
        $disease = $num['disease'];
        $allergy = $num['allergy'];
        $prescription = $num['prescription'];
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>invoice</title>
    <link rel="stylesheet" type="text/css" href="css/print.css" media="print">
    <style>
        * {
            box-sizing: border-box;
            /* margin: 0px;
            padding: 0px; */
        }

        body {
            background-image: url("image/bg15.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            /* width:100%; */
            /* padding: 0px; */
        }

        .container {
            box-sizing: border-box;
            align-items: center;
            font-size: 18px;
            width: 100%;
            height: 29cm;
            border: 2px solid black;
            /* margin-left: 0px; */
        }

        .headerdiv {
            /* text-align: center; */
            display: grid;
            grid-template-columns: 2fr 3fr;
        }

        .row {
            display: flex;
            /* grid-template-columns: 1fr 1fr; */
            margin-top: 50px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        .patient_information {
            width: 50%;
            /* text-align: center; */
            /* padding-left: 30%; */
            font-weight: bold;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: center;

        }

        .doctor_information {
            width: 50%;
            /* text-align: center; */
            /* padding-left: 30%; */
            font-weight: bold;
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            align-content: center;
        }

        .divtable {
            display: flex;
            border: 2px solid black;
            grid-template-columns: 3fr 1fr;
            width: 80%;
            flex-wrap: wrap;
            flex-direction: row;
        }

        .table {
            width: 100%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .item {
            width: 70%;
            text-align: center;
            border-right: 2px solid;
        }

        .amount {
            width: 30%;
            text-align: center;

        }

        .itemhead {
            text-align: center;
            border-top: none;
            padding: 10px 20px;
        }

        .items {
            text-align: left;
            /* border-top: 2px solid; */
            padding: 10px 20px;
        }

        .amounts {
            text-align: right;
            /* border-top: 2px solid; */
            padding: 10px 20px;
        }

        .heading {
            color: blue;
            text-decoration: underline;
        }

        hr {
            width: 80%;
            border: 2px solid black;

            /* height: 2px; */
        }

        .prescription_box {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .prescription_table {
            display: grid;
            grid-template-columns: 2fr 3fr;
            width: 80%;
        }

        .prescription_heading {
            font-weight: bold;
        }

        .pres_text {
            padding-left: 10%;
            margin-top: 80px;
        }

        .btn {
            align-items: start;
            border-bottom-style: dotted;
        }

        #print {
            background-color: green;
            color: white;
            font-size: 18px;
            padding: 3px 50px;
        }

        #print:hover {
            opacity: 0.5;
            cursor: pointer;
        }

        .icon_image {
            width: 100px;
            height: 100px;
        }

        .icon {
            text-align: right;
            padding-top: 16px;
            padding-right: 30px;
        }

        #back {
            text-decoration: none;
            background-color: blue;
            color: white;
            font-size: 18px;
            padding: 5px 50px;
        }

        @media only screen and (max-width:500px) {

            .doctor_information,
            .doctor_information {
                width: 100%;
            }

            .container {
                height: fit-content;
            }

            .divtable,
            .prescription_table {
                width: 90%;
            }

        }
    </style>
</head>

<body>

    <div class="btn">
        <button onclick="window.print()" id="print">Print</button>
        <a href="<?
        if ($adminflag > 0) {
            echo "adminsample.php";
        } else {
            echo "patientsample.php";
        }
        ?>" id="back">Back</a>
    </div>
    <div class="container">

        <div class="headerdiv">
            <div class="icon">
                <img src="image/solidarity1.png" class="icon_image">
            </div>
            <div class="name">
                <h1>Assp Hospital</h1>
                <p>kothrud,pune</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="patient_information">
                <p class="heading">PATIENT INFORMATION</p>
                <p>
                    <? echo $fname . "&nbsp;&nbsp;" . $lname; ?>
                </p>
                <p>
                    <?= $gender; ?>
                </p>
                <p>
                    <? echo $email; ?>
                </p>
                <p>
                    <? echo $contact; ?>
                </p>
            </div>
            <div class="doctor_information">
                <p class="heading">DOCTOR INFORMATION</p>
                <p>Dr.
                    <? echo $doctorname; ?>
                </p>
                <p>
                    <? echo $doctorspec; ?>
                </p>
                <p>
                    <? echo $doctoremail; ?>
                </p>
            </div>
        </div>
        <div class="table">
            <div class="divtable">
                <div class="item">
                    <div class="itemhead"> item</div>
                </div>
                <div class="amount">
                    <div class="itemhead">Amount</div>
                </div>
            </div>
            <div class="divtable">
                <div class="item">
                    <div class="items">Appointment Charges</div>
                </div>
                <div class="amount">
                    <div class="amounts">
                        <? echo $doctorfees; ?>
                    </div>
                </div>
            </div>
            <div class="divtable">
                <div class="item">
                    <div class="items" style="text-align: right;">Sub-Total</div>
                </div>
                <div class="amount">
                    <div class="amounts">
                        <? echo $doctorfees; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="pres_text">
            <h3>Prescriptions :</h3>
        </div>
        <hr>
        <div class="prescription_box">
            <!-- <p>Prescriptions:</p> -->
            <div class="prescription_table">
                <div class="prescription_heading">
                    <p>Disease</p>
                </div>
                <div class="presciption_data">
                    <p>
                        <? echo $disease; ?>
                    </p>
                </div>
                <div class="prescription_heading">
                    <p>Allergy</p>
                </div>
                <div class="presciption_data">
                    <p>
                        <? echo $allergy; ?>
                    </p>
                </div>
                <div class="prescription_heading">
                    <p>Prescription</p>
                </div>
                <div class="presciption_data">
                    <p>
                        <? echo $prescription; ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</body>

</html>