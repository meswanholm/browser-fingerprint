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
			<h1>Eingabe</h1>
			<br />
		<form action="bb_form2.php" method="post">
		Betreff:
		<br />
		<input type="text" name="1" value="" size="40" />
		<br />
		<br />
		Autor:
		<br />
		<select name="2">
		<?php
		$link = mysql_connect("localhost", "dw050", "Uneec2ohza");
		if (!$link){
		die('Could not connect: ' . mysql_error());
		}
		if (!mysql_select_db("u-dw050")){
		die('Could not select db: ' . mysql_error());
		}
		    $sql = "SELECT name FROM mitglied";
		    $result = mysql_query($sql) OR die(mysql_error());
        	while($row = mysql_fetch_assoc($result)) {
				echo "<option>" . $row['name'] . "</option>"; 
			}
		?> 
 		</select>
		<br />
		<br />
		PIN:
		<br />
		<input type="text" name="5" value="" size="40" /> 
		<br />
		<br />
		Text: 
		<br />
		<textarea cols="50" rows="6" name="3">  </textarea>
		<br />
		<br />
		<input type="submit" name="4" value="abschicken"/>
		</form>
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