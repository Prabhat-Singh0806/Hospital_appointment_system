<?

include 'dbconfig.php';


$name = $_REQUEST['name'];
$email = $_REQUEST['email'];
$contact = $_REQUEST['contact'];
$message = $_REQUEST['message'];
$sql = "INSERT INTO `contact` (`name`, `email`, `contact`, `message`) VALUES ('$name', '$email', '$contact', '$message');";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>feedback</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            height: 100vh;
            flex-wrap: wrap;
            justify-content: center;
            align-content: center;
        }

        .container {
            display: flex;
            width: 70%;
            flex-wrap: wrap;
            justify-content: center;
            /* border: 1px solid black; */
            height: 15vh;
        }

        .content {
            width: 100%;
            display: flex;
            justify-content: center;
            /* flex-direction: column; */
            align-content: center;
            flex-wrap: wrap;
            font-size: 21px;
        }

        .btn_container {
            width: 100%;
            display: flex;
            justify-content: center;
            /* flex-direction: column; */
            align-content: center;
            flex-wrap: wrap;
        }

        .feedback_close {
            color: white;
            display: block;
            text-decoration: none;
            text-align: center;
            width: 20%;
            padding: 5px;
            background-color: blue;
            border-radius: 7px;
        }

        @media only screen and (max-width:500px) {
            .container {
                width: 95%;
                border: none;
            }

            .feedback_close {
                width: 50%;
            }

            .content {
                font-size: 16px;
                text-align: center;
            }

        }
    </style>
</head>

<body>
    <div class="container">
        <?
        if ($result) {
            ?>
            <div class="content">
                your feedback has been succesfully Submitted
            </div>
            <div class="btn_container">
                <a href="index.html" class="feedback_close">Click to continue</a>
            </div>
        <?
        } else {
            ?>
            <div class="content">
                your feedback has not been Submitted please contact Admin for further Assistance
            </div>
            <div class="btn_container">
                <a href="index.html" class="feedback_close" style="background-color: red;">Click to continue</a>
            </div>
        <?
        }
        ?>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>