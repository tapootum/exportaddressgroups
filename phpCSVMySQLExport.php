<html>
<head>
<title>TapooTum PHP & MySQL To CSV</title>
</head>
<body>
<?
$filName = "customer.csv";
$objWrite = fopen($filName, "w");

$objConnect = mysql_connect("localhost","root","kawaoisoki") or die("Error Connect to Database");
$objDB = mysql_select_db("mail");
$strSQL = "SELECT address.*,addressgroups.* FROM address,addressgroups WHERE addressgroups.nickname = address.nickname and  addressgroups.owner = '$user' and address.owner = addressgroups.owner";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

while($objResult = mysql_fetch_array($objQuery))
{
	fwrite($objWrite, "\"$objResult[nickname]\",\"$objResult[firstname]\",\"$objResult[firstname]\",");
	fwrite($objWrite, "\"$objResult[lastname]\",\"$objResult[email]\",\"$objResult[label]\" \n");
}
fclose($objWrite);
echo "<br>Generate CSV Done.<br><a href=$filName>Download</a>";
?>
</table>
</body>
</html>
