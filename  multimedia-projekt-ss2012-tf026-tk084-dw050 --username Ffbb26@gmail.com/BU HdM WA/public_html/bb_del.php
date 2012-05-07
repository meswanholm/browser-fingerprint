<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>PVL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link href="bb.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="652" cellpadding="0" cellspacing="0">
	<tr>
		<td colspan="6">
			<img src="siteimages/top.jpg" width="651" height="146" alt="" /></td>
		<td rowspan="4">
			<img src="siteimages/PVL_02.jpg" width="1" height="495" alt=""/></td>
	</tr>
	<tr>
		<td>
			<a href="index.php">
			<img src="siteimages/news.jpg" width="73" height="34" alt=""/></a></td>
		<td>
			<a href="team.php">
			<img src="siteimages/team.jpg" width="72" height="34" alt="" /></a></td>
		<td>
			<img src="siteimages/blank.jpg" width="285" height="34" alt=""/></td>
		<td>
			<a href="calc.html">
			<img src="siteimages/rechner.jpg" width="73" height="34" alt=""/></a></td>
		<td>
			<img src="siteimages/misc.jpg" width="73" height="34" alt=""/></td>
		<td>
			<a href="impressum.html">
			<img src="siteimages/impressum.jpg" width="75" height="34" alt=""/></a></td>
	</tr>
	
	<tr>		
		<td colspan="6">
		<div class="contentbg"> 
			<br />
			<div class="content"> 
			<h1>Löschen eines Beitrages</h1>
		<?php
		$link = mysql_connect("localhost", "dw050", "Uneec2ohza");
		if (!$link)
			{die('Could not connect: ' . mysql_error());
			}
		
		if (!mysql_select_db("u-dw050"))
			{die('Could not select db: ' . mysql_error());
			}
		
		//SQL
		$id = $_GET['id'];
		
		//Name holen & umwandeln
		$getname=mysql_query("SELECT tid FROM news WHERE id=$id");
		$savename=mysql_result($getname,0);
		$selectname=mysql_query("SELECT name FROM mitglied WHERE id=$savename");
		$printname=mysql_result($selectname,0);
		mysql_close();
		?>
		
		Löschen ist nur durch den Autor möglich. Bitte geben Sie Ihre PIN ein.
		<br />
		<br />
		<form action="bb_del2.php?id=<?php echo $id; ?>" method="post">
		Name:
		<br />
		<input type="text" name="1" value="<?php echo $printname; ?>" readonly="readonly" size="20" />
		<br />
		<br />
		PIN:
		<br />
		<input type="text" name="2" value="" size="20" />
		<br />
		<br />
		<br />
		<input type="submit" name="3" value="abschicken"/>
		</form>
		<br/>
		<br/>
		</div>
		</div>
		</td>			
	</tr>
	
	<tr>
		<td colspan="6">
		<img src="siteimages/PVL_10.jpg" width="651" height="53" alt="" />
		</td>
	</tr>
		
</table>
</body>
</html>