<!--
/*********************************************************************************/
/*			                  Source History									 */
/*-------------------------------------------------------------------------------*/
/*2011-11-18|DW: Erste Version													 */
/*			|TF: BildflÃ¤che eingefÃ¼gt 'content_images', mÃ¼sste natÃ¼rlich mit PHP */	
/*				 dynamisch programmiert werden.									 */
/*2011-12-23|TF: Jquery Skripte hinzugefÃ¼gt										 */
/*			|TF: Login button implementiert										 */
/*																				 */
/*********************************************************************************/
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
<a href="http://mars.iuk.hdm-stuttgart.de/~tf026/default.html"><img id="top_image" src="images/logo.png" alt="Logo"/></a>

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
<div id="loginLogout">
<?php
	session_start();
	
	//Objekt der Klasse Message wir erzeugt
	require_once 'message.php';
	$message_class = new Message();
	
	echo($message_class->createLoginOrLogoutButton());
?>
</div>

<div id="refresh">Sie sind nicht eingeloggt.</div>

<?php 
	include('auth.php');
	include('login_popup.php');
?>

<div id="top_navi">
<table id="navigation_table">
	<tr>
		<td id="navibutton_1"><a href="http://mars.iuk.hdm-stuttgart.de/~tf026/default.html">Home</a></td>
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
Schloss Neuschwanstein kann nur im Rahmen einer FÃ¼hrung besichtigt werden. Deutsch- und englischsprachige Besucher 
werden durch das Personal der Bayerischen SchlÃ¶sserverwaltung gefÃ¼hrt, fÃ¼r alle anderen Besucher werden begleitete 
Audio-Guide-FÃ¼hrungen in den Sprachen Japanisch, FranzÃ¶sisch, Spanisch, Italienisch, Tschechisch, Slowenisch, Russisch, 
Polnisch, Chinesisch (Mandarin), Portugiesisch, Ungarisch, Griechisch und HollÃ¤ndisch angeboten.
</br>
</br>
Alle FÃ¼hrungen dauern ca. 30 Minuten.
</br>
</br>
FÃ¼hrungsreservierungen sind bis spÃ¤testens einen Tag vor dem gewÃ¼nschten Schlossbesuch beim Ticketcenter Hohenschwangau 
mÃ¶glich.
</div>
</br>
</br>
<div id="bottom">Impressum</div>

</body>

</html>
