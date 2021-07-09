<?php
/* Check Login Functions  */


/* Admin Check Login  */
function admin_check_login()
{
	if ((strlen($_SESSION['id']) == 0)) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php";
		$_SESSION["id"] = "";
		header("Location: http://$host$uri/$extra");
	}
}


/*  Staff/ Lec  */
function staff()
{
	if ((strlen($_SESSION['id']) == 0) && (strlen($_SESSION['number']) == '0')) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php";
		$_SESSION["id"] = "";
		$_SESSION["number"] = "";
		header("Location: http://$host$uri/$extra");
	}
}

/* Studets Check Login */
function student()
{
	if ((strlen($_SESSION['id']) == 0) && (strlen($_SESSION['admno']) == '0')) {
		$host = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = "index.php";
		$_SESSION["id"] = "";
		$_SESSION["admno"] = "";
		header("Location: http://$host$uri/$extra");
	}
}
