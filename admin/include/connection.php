<?php
define('DBHOST','localhost');
define('DBUSER','root');
define('DBPASS','');
define('DBNAME','kitchenware');

$con = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if (!$con){
	die('Connection Failed:'. mysqli_connect_error());
}
