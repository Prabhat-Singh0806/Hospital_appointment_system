<?
include 'session.php';
include 'dbconfig.php';
try {
    $pid = $_REQUEST['pid'];
    $fname = $_REQUEST['fname'];
    $email = $_REQUEST['email'];
    $username = $_REQUEST['username'];
    // echo $pid;
    // echo $email;

} catch (Exception $e) {

}
if (isset($_POST['yes'])) {
    if ($pid != null) {
        $sql = "DELETE FROM patreg WHERE pid = '$pid'";
        $result = mysqli_query($conn, $sql);
    }
    if ($email != null) {
        $sql = "DELETE FROM doctb WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .container {
            display: flex;
            /* justify-content: center; */

        }

        .removecontainer {
            margin: 23vh auto;
            display: flex;
            border: 2px solid black;
            flex-wrap: wrap;
            width: 50% auto;
            justify-content: center;
            padding-bottom: 12px;
            border-radius: 5px;
        }

        .removeheading {
            text-align: center;
            width: 100%;
        }

        .removecontent {
            text-align: center;
            width: 100%;
        }

        .removeoption {
            display: flex;
            width: 80%;
            /* border: 2px solid red; */
            margin-top: 3%;
        }

        .yes {
            width: 50%;
            text-align: center;
        }

        .no {
            width: 50%;
            text-align: center;
        }

        .btn {
            background-color: green;
            color: white;
            font-size: 18px;
            border: none;
            padding: 3px 0px 3px 0px;
            width: 40%;
            border-radius: 7px;
        }

        .no_btn {
            background-color: red;
        }

        .ok {
            width: 100%;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <?
        if (!$result) {
            ?>
            <div class="removecontainer">
                <div class="removeheading">
                    <h2>Remove
                        <? echo $fname;
                        echo $username; ?>
                    </h2>

                </div>
                <div class="removecontent">
                    <p><b>Do you really want to delete
                            <? echo $fname;
                            echo $username; ?> account from your system
                        </b></p>
                </div>
                <div class="removeoption">
                    <div class="yes">
                        <form action="<? echo $_SERVER['PHP_SELF']; ?>" method="post">
                            <input type="hidden" name="pid" value="<?= $pid ?>">
                            <input type="hidden" name="email" value="<?= $email ?>">
                            <button type="submit" class="btn" name="yes">Yes</button>
                        </form>
                    </div>
                    <div class="no">
                        <form action="adminsample.php" method="post"><button type="submit" class="btn no_btn">No</button>
                        </form>
                    </div>
                </div>
            </div>
        <?
        } else {
            ?>
            <div class="removecontainer">
                <div class="removeheading">
                    <h3>Account Deleted Succesfully</h3>
                </div>
                <div class="removeoption">
                    <div class="ok">
                        <form action="adminsample.php" method="post">
                            <button type="submit" class="btn" name="yes">OK</button>
                        </form>
                    </div>
                </div>
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