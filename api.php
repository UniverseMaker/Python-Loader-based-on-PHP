<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include_once './config/dbconfig.php';

$command = $_REQUEST["command"];
$data = $_REQUEST["data"];

if($command == ""){
	echo "Empty Parameters";
	exit();
}

if($command == "6" || $command == "7" || $command == "8"){
	//database logging
	$query = "SELECT * FROM transaction WHERE command=${command} ORDER BY id DESC";
	$result = mysqli_query($dbconnect, $query);
	$data = mysqli_fetch_assoc($result);
	if(isset($data['id']))
		echo $data['data'];
	else
		echo "-1";
}
else{
	//call python code or application
	$clicmd = escapeshellcmd("sudo your/python/application/or/code ${command} ${data}");
	$output = shell_exec($clicmd);
	echo $data;
}
?>