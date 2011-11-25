<html>
<head>
<title>TaPooTum  Export Address group Squirrelmail to csv</title>
</head>
<body>
<?
$user = $_POST["user"];
$group = $_POST["group"];
$objConnect = mysql_connect("localhost","root","kawaoisoki") or die("Error Connect to Database");
$objDB = mysql_select_db("mail");
$strSQL = "SELECT address.*,addressgroups.* FROM address,addressgroups ".
	  "WHERE addressgroups.nickname = address.nickname and  addressgroups.owner = "$user" and address.owner = addressgroups.owner";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
<table width="600" border="1">
  <tr>
    <th width="91"> <div align="center">Nickname </div></th>
    <th width="98"> <div align="center">FirstName </div></th>
    <th width="198"> <div align="center">Lastname </div></th>
    <th width="97"> <div align="center">E-mail </div></th>
    <th width="59"> <div align="center">Label </div></th>
    <th width="71"> <div align="center">Owner </div></th>
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
    <td align="right"><?=$objResult["owner"];?></td>
  </tr>
<?
}
?>
</table>
<?
mysql_close($objConnect);
?>
<div align="center"><br>
  <input name="btnExport" type="button" value="Export" onClick="JavaScript:window.location='phpCSVMySQLExport.php';">
</div>
</body>
</html>
