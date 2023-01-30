<?php 
$host = "localhost";
$dbname="login_sams";
$username="root";
$password="";

$conn = mysqli_connect('localhost', 'root', '', 'login_sams');
if(!$conn){
    die("coś poszło nie tak kurwwwa");
}
?>