<?php ob_start();

$db['db_host'] = "localhost";
$db['db_user'] = "phpmyadminapp";
$db['db_pass'] = "db760ef280a42d6872cdc8d8214c03b585999cacd053982e";
$db['db_name'] = "patrizzardi";

foreach($db as $key => $value){
define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);



$query = "SET NAMES utf8";
mysqli_query($connection,$query);

//if($connection) {
//
//echo "We are connected";
//
//}








?>