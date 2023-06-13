<?
$servername="localhost";
 $username="prabhatsingh_root";
 $password="prabhatsingh_root";
 //$password="";
 $dbname='prabhatsingh_myhmsdb';
 // Create conecction
 $conn =mysqli_connect($servername, $username, $password, $dbname);
 //creating connection
  if(!$conn){echo -2;}//checking connection
  ?>