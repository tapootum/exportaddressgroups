<html>
<head>
<title>TaPooTum  Export Address group Squirrelmail to csv</title>
</head>
<body>
<?
$user = $_POST["user"];
$group = $_POST["group"];
$objConnect = mysql_connect("localhost","root","pass") or die("Error Connect to Database");
$objDB = mysql_select_db("mail");
$strSQL = "SELECT address.*,addressgroups.* FROM address,addressgroups ".
	  "WHERE addressgroups.nickname = address.nickname and  addressgroups.owner = '$user' and address.owner = addressgroups.owner ORDER BY addressgroups.addressgroup";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">Nickname </div></th>
    <th width="98"> <div align="center">FirstName </div></th>
    <th width="198"> <div align="center">Lastname </div></th>
    <th width="97"> <div align="center">E-mail </div></th>
    <th width="59"> <div align="center">Label </div></th>
    <th width="71"> <div align="center">Group </div></th>
  </tr>
<?
while($objResult = mysql_fetch_array($objQuery))
{
?>
  <tr>
    <td><div align="center"><?=$objResult["nickname"];?></div></td>
    <td><?=$objResult["firstname"];?></td>
    <td><?=$objResult["lastname"];?></td>
    <td><div align="center"><?=$objResult["email"];?></div></td>
    <td align="right"><?=$objResult["label"];?></td>
    <td align="right"><?=$objResult["addressgroup"];?></td>
  </tr>

<?
}
?>
</table>
	

<?


$strSQL = "SELECT DISTINCT addressgroups.addressgroup FROM addressgroups ".
          "WHERE addressgroups.owner = '$user'";

$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
$i = 0;
while($objResult = mysql_fetch_array($objQuery))
{
$array[$i]=$objResult["addressgroup"];
$i=$i+1;
}

for ($j=0;$j<=$i;$j=$j+1){
echo $array[$j];
}


?>


<?




mysql_close($objConnect);
?>
<div align="center"><br>
</div>
<?




for ($j=0;$j<=$i;$j++){

	$filName = "user-".$user."-gruop-".$array[$j].".csv";
	$path = "/csv/".$filName;
	$objWrite = fopen($path, "w+");

	$objConnect = mysql_connect("localhost","root","pass") or die("Error Connect to Database");
	$objDB = mysql_select_db("mail");
	$strSQL = "SELECT address.*,addressgroups.* FROM address,addressgroups WHERE addressgroups.nickname = address.nickname and ".
		  "addressgroups.owner = '$user' and address.owner = addressgroups.owner and ".
		  "addressgroups.addressgroup = '$array[$j]'";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");


	fwrite($objWrite, "\"nickname\",\"name\",\"First Name\",\"Last Name\",\"E-mail Address\",\"label\"\n");

	while($objResult = mysql_fetch_array($objQuery))
	{	
	fwrite($objWrite, "\"$objResult[nickname]\",\"$objResult[firstname]\",\"$objResult[firstname]\",");
	fwrite($objWrite, "\"$objResult[lastname]\",\"$objResult[email]\",\"$objResult[label]\" \n");
	}
	fclose($objWrite);
	echo "<br>Generate ";
	echo $filName;
	echo " Done.<br><a href=$path>Download</a>";

}


?>
</body>
</html>
