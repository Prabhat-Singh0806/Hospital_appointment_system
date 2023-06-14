<?
include 'session.php';
include 'dbconfig.php';
$pid = $_REQUEST['pid'];
if (isset($_POST['view_pro'])) {
    $sql = "SELECT * FROM `patreg` WHERE pid = '$pid'";
    $result = mysqli_query($conn, $sql);
    while ($num = mysqli_fetch_assoc($result)) {
        $pid = $num['pid'];
        $fname = $num['fname'];
        $lname = $num['lname'];
        $gender = $num['gender'];
        $email = $num['email'];
        $mobile = $num['contact'];
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-image: url("image/bg9.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            width: 50%;
            height: 50vh;
            border: 1px solid;
        }

        .flexc {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-content: center;
        }

        .tableinternal {
            width: 60%;
            overflow: scroll;
        }

        .tableinternal::-webkit-scrollbar {
            display: none;
        }

        .firstcol,
        .secondcol {
            width: 32%;
            padding: 5px;
            text-align: left;
            font-weight: bold;
            /* border-bottom: 1px solid; */
        }

        .firstcol {
            text-align: justify;
        }

        .back {
            width: 80%;
            height: 10vh;
        }

        .back a {
            display: block;
            text-decoration: none;
            /* background-color: rgb(119 229 119); */
            color: black;
            padding: 10px;
            width: 20%;
            text-align: center;
            font-weight: bold;
            border: 2px solid green;
            border-radius: 7px;

        }

        .back a:hover {
            background-color: green;
            color: white;
        }

        @media only screen and (max-width:500px) {

            .container,
            .tableinternal {
                width: 95%;
            }

            .back a {
                padding: 8px;
                width: 30%;
            }

            .firstcol {
                width: 25%;
            }

            .secondcol {
                width: 60%;
            }
        }
    </style>
</head>

<body class="flexc" style="height: 100vh;">
    <div class="container flexc">
        <div class="tableinternal flexc">
            <div class="firstcol">
                Name
            </div>
            <div class="secondcol">
                <?= $fname ?> &nbsp;&nbsp;
                <?= $lname ?>
            </div>
            <div class="firstcol">
                Email
            </div>
            <div class="secondcol">
                <?= $email ?>
            </div>
            <div class="firstcol">
                contact
            </div>
            <div class="secondcol">
                <?= $mobile ?>
            </div>
            <div class="firstcol">
                gender
            </div>
            <div class="secondcol">
                <?= $gender ?>
            </div>
            <div class="firstcol">
                ID
            </div>
            <div class="secondcol">
                <?= $pid ?>
            </div>
        </div>
        <div class="back flexc">
            <a href="patientsample.php">Back</a>
        </div>
    </div>
</body>

</html>