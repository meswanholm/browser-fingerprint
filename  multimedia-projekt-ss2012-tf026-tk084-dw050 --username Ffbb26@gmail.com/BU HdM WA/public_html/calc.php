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
			<h1>Taschenrechner</h1>
			<br />
			<body>
		<?php
		$a=$_GET["a"];
		$b=$_GET["b"];
		$op=$_GET["op"];
		
		if ($op == '+') {
    		echo $a. " + ".$b. " = ".($a+$b);
   		} 
   		elseif ($op == '-') {
   			echo $a. " - ".$b. " = ".($a-$b);
		} 
   		elseif ($op == '/') {
   			echo $a. " / ".$b. " = ".($a/$b);
		}
		elseif ($op == '*') {
   			echo $a. " * ".$b. " = ".($a*$b);
		}

		?>
<br />	
<b>Nicht überzeugt? - Dann rechne nochmal und klicke</b>	
<a href="calc.html">hier!</a>
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
