<?php
	$con = mysql_connect("localhost","root","kawaoisoki");
		if (!$con)
  		{  die('Could not connect: ' . mysql_error()); }
	$user = $_POST["user"];
	$group = $_POST["group"];
	
mysql_select_db("mail", $con);
	

	$sql = "select address.*".
		" from address,addressgroups ".
		"where address.owner = '$user' ".
		"and addressgroups.nickname = address.nickname ".
		"and addressgroups.addressgroup = '$group'";
	$result=mysql_query($sql);

	while($row = mysql_fetch_array($result))
 	 {
  	echo  
		$row['nickname'] . " " . 
		$row['firstname'] . " " . 
		$row['lastname'] . " " . 
		$row['email'] . " " . 
		$row['label'];
  	echo "<br />";
  	}

	
	mysql_close($con);
?>
