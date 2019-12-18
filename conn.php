<?php

//display all php errors with these
ini_set('display_errors, 1');
ini_set('display_startup_errors, 1');
error_reporting(E_ALL);


/*-- step 2 make session on conn page-->*/

session_start(); //starts a session to pass your session variables (for sites with logins)
if(!isset($_SESSION)) session_start();

if($_SERVER["SERVER_NAME"] == "dev.moprhemedia.ca"){
$conn = mysqli_connect("localhost", "root", "root", "major2");
}else{
    
    $conn = mysqli_connect("localhost", "root", "root", "major2");
}
if(mysqli_connect_errno( $conn )){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();

}





?>
