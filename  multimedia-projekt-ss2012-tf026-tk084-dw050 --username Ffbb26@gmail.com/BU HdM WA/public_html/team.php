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
			<h2>Übersicht der Mitglieder</h2>
		<br />
		
		<table border="1">
			<tr>
			<th style="width: 100px">Name</th> 
			<th style="width: 100px">Vorname</th> 
			<th style="width: 180px">Bild</th> 
			</tr>
		
		<?php
		$link = mysql_connect("localhost", "dw050", "Uneec2ohza");
		if (!$link){
		die('Could not connect: ' . mysql_error());
		}
		if (!mysql_select_db("u-dw050")){
		die('Could not select db: ' . mysql_error());
		}
				
			$abfrage = "SELECT * FROM mitglied ORDER BY name ASC";
			$ergebnis = mysql_query($abfrage);
			$zeilenanzahl = mysql_num_rows($ergebnis);
			$zeilennummer = 0;
						
			while ($zeilennummer < $zeilenanzahl) {
				$id = mysql_result($ergebnis,$zeilennummer,'id');
				$name = mysql_result($ergebnis,$zeilennummer,'name');
				$vorname =	mysql_result($ergebnis,$zeilennummer,'vorname');
				$bildpfad =	mysql_result($ergebnis,$zeilennummer,'bildpfad');
			echo "<tr><td>$name</td><td>$vorname</td><td>
			<img src = $bildpfad /></td></tr>\n";
			$zeilennummer=$zeilennummer+1;				}
		mysql_close();
//		echo nl2br("\n\n");
		?>	
		</table>
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