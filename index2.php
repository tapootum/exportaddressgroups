<?php
	$con = mysql_connect("localhost","root","123456789");
		if (!$con)
  		{  die('Could not connect: ' . mysql_error()); }
	$user = $_POST["user"];
	#$group = $_POST["group"];

	


#################################################
	mysql_select_db("mail", $con);
	

	$sql = "select address.* from address,addressgroups where addressgroups.owner = $user and (addressgroups.nickname = address.nickname = $user;
	$result=mysql_query($sql);

	while($row = mysql_fetch_array($result))
 	 {
  	echo $row['FirstName'] . " " . $row['LastName'];
  	echo "<br />";
  	}

	
	mysql_close($con);
?>
