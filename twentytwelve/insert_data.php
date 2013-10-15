<?php
//session_start();

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	}
	else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

function prevPageURL() {
	$page = $_SERVER["HTTP_REFERER"];
	return $page;
}

function insertData(){
	$host = "telesto.gr";
	$user = "telesto_salonika";
	$pass = "s@l0n1k@";
	$db_name = "telesto_salonikacrm";

	// Create connection
	$connection = mysqli_connect($host, $user, $pass, $db_name);

	// Check connection
	if(mysqli_connect_errno($connection)) {
		echo "Failed to connect to MySQL: " .mysqli_connect_error();
	}
	// Select Database
	mysqli_select_db($connection, "telesto_salonikacrm") or die(mysql_error());

	$UID = $_SESSION['UID'];
	if(isset($UID)){
		$sql = "SELECT UID FROM user WHERE UID='" .$UID ."'";

		// Execute query
		$result = mysqli_query($connection, $sql);

		if($result == FALSE) {
			die("<br>ERROR21: " .mysqli_error($connection));
		}

		// Read rows
		while($row = mysqli_fetch_array($result)){
		
			if($row == FALSE) {
				die("<br>ERROR25: " .mysqli_error($connection));
			}

			if($row['UID'] == $UID) {
				
				$page = prevPageURL();
				$starttime = $_SESSION['starttime'];
				
				if(!get_magic_quotes_gpc()){
					$page = addslashes($page);
				}
	
				if(!filter_var($page, FILTER_VALIDATE_URL)){
					die($page ."<br>Error15: URL is not valid");
				}

				$sql = "INSERT INTO pages (page, UID, starttime) VALUES ('$page', '$UID', '$starttime')";
	
				// Execute query
				if(mysqli_query($connection, $sql)){
					//echo "1 record added...";
				}
				else {
					die("Error0: " .mysqli_error($connection));
				}
			} 
			else {
				//echo "<br>3You Are Not In DB. Please Give us your EMAIL<br>";
			}
		}
	}
	else {
		echo "<br>not specified user<br>";
	}
	mysqli_close($connection);
	//var_dump('Success!');
}
?>
