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
			<h2>Detailübersicht</h2>
		<br />
		<?php
		$link = mysql_connect("localhost", "dw050", "Uneec2ohza");
		if (!$link){
		die('Could not connect: ' . mysql_error());
		}
		if (!mysql_select_db("u-dw050")){
		die('Could not select db: ' . mysql_error());
		}

			//SQL
			$id = $_GET['id'];
			$ergebnis = mysql_query("SELECT * FROM news WHERE id=$id");
			$zeilenanzahl = mysql_num_rows($ergebnis);
			$zeilennummer = 0;
			
		
			while ($zeilennummer < $zeilenanzahl) {
				$id = mysql_result($ergebnis,$zeilennummer,'id');
				$betreff = mysql_result($ergebnis,$zeilennummer,'betreff');
				$tid =	mysql_result($ergebnis,$zeilennummer,'tid');
				$datum =mysql_result($ergebnis,$zeilennummer,'datum');
				$text =	mysql_result($ergebnis,$zeilennummer,'text');
				$name = mysql_query("SELECT name FROM mitglied WHERE id=$tid");
				$picture= mysql_query("SELECT bildpfad FROM mitglied WHERE id=$tid");
				$sqlname = mysql_result($name,0);
				$sqlpicture= mysql_result($picture,0);

				$zeilennummer=$zeilennummer+1;	
			}
		mysql_close()
		?>
			<table style="width: 100%">
			<tr>
				<td style="width: 80px; height: 35px">Betreff:</td>
				<td style="width: 250px; height: 35px"><?php echo "$betreff";?></td>
				<td rowspan="3"><?php echo "<img src = $sqlpicture />";?></td>
			</tr>
			<tr>
				<td style="width: 80px; height: 35px">Name:</td>
				<td style="width: 250px; height: 35px"><?php echo "$sqlname";?></td>
			</tr>
			<tr>
				<td style="width: 80px; height: 35px">Datum:</td>
				<td style="width: 250px; height: 35px"><?php echo "$datum";?></td>
			</tr>
			<tr>
				<td colspan="3" style="height: 19px">&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3" style="height: 19px"><?php echo "$text";?></td>
			</tr>
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