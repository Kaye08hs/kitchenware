<?php
	session_start();
	header('location:../student/student_login.php');
	session_destroy();
?>