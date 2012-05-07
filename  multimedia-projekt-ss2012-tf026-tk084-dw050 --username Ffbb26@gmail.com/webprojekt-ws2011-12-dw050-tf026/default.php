<!--
/******************************************************************************************/
/*			                  Source History									          */
/*----------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Einstiegsseite. 'auth.php' (Checkt die Session)                           */          
/*			    'login_popup.php' (Baut das JQuery Login Dialog) werden hinzugeladen      */
/*----------------------------------------------------------------------------------------*/
/*2011-11-18|DW: Erste Version													          */
/*			|TF: Bildfläche eingefügt 'content_images', müsste natürlich mit PHP          */	
/*				 dynamisch programmiert werden.									          */
/*2011-12-23|TF: Jquery Skripte hinzugefügt										          */
/*			|TF: Login button implementiert										          */
/*																				          */
/******************************************************************************************/
-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="default_standart.css" />
<link rel="stylesheet" type="text/css" href="default_mobile.css" media="only screen and (max-device-width:480px) and (min-device-width:300px)" />

<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>excursion.de</title>
	
</head>
<body>
<a href="default.php"><img id="top_image" src="images/logo.png" alt="Logo"/></a>

<div id="dialog_form" title="Anmeldung">
	<form>
	<fieldset>
		<label for="user">Benutzername</label>
		<input type="text" name="user" id="user" value="" class="text ui-widget-content ui-corner-all" />
		<label for="password">Passwort</label>
		<input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>
<button id="logout_Button">Logout</button>
<button id="login_Button">Login</button>

<div id="refresh">Sie sind nicht eingeloggt.</div>

<?php 
	session_start();
	//Inhalt der PHP Dateien werden hinzugefügt
	include('auth.php');
	include('login_popup.php');
?>

<div id="top_navi">
<table id="navigation_table">
	<tr>
		<td id="navibutton_1"><a href="default.php">Home</a></td>
		<td id="navibutton_2">Touren</td>
		<td id="navibutton_3">Community</td>
		<td id="navibutton_4">News</td>
		<td id="navibutton_5">Tipps und Termine</td>
	</tr>
</table>
</div>	

<div class="content"> 
<img id="content_images" src="images/contentImage_Neuschwanstein.jpg" alt="Schloss Neuschwanstein"/>
<h2>Schloss Neuschwanstein</h2>
Schloss Neuschwanstein kann nur im Rahmen einer Führung besichtigt werden. Deutsch- und englischsprachige Besucher 
werden durch das Personal der Bayerischen Schlösserverwaltung geführt, für alle anderen Besucher werden begleitete 
Audio-Guide-Führungen in den Sprachen Japanisch, Französisch, Spanisch, Italienisch, Tschechisch, Slowenisch, Russisch, 
Polnisch, Chinesisch (Mandarin), Portugiesisch, Ungarisch, Griechisch und Holländisch angeboten.
</br>
</br>
Alle Führungen dauern ca. 30 Minuten.
</br>
</br>
Führungsreservierungen sind bis spätestens einen Tag vor dem gewünschten Schlossbesuch beim Ticketcenter Hohenschwangau 
möglich.
</div>
</br>
</br>
<div id="bottom">Impressum</div>

</body>
</html>
