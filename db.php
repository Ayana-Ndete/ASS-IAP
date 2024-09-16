<?php
$dbname = 'api';
$dbhost='localhost';
$dbpass = '1234';
$dbuser = 'ayana';

$conn = mysqli_connect($dbhost , $dbuser,$dbpass,$dbname);
if($conn->connect_error){
  echo " connection failed";

}
else{
  echo " ";
}
