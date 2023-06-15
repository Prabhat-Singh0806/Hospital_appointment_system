<?
$servername = "localhost";
$username = "root";
$password = "root";
//$password="";
$dbname = 'myhmsdb';
// Create conecction
$conn = mysqli_connect($servername, $username, $password, $dbname);
//creating connection
if (!$conn) {
    echo -2;
} //checking connection
?>