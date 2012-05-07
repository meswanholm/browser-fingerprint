<!--
/**********************************************************************************************/
/*			                  Source History									              */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Öffnet und gibt die 'login_popup.js' aus -> PHP ist der König :-)             */
/*--------------------------------------------------------------------------------------------*/
/*2011-11-18|TF: Erste Version												                  */
/*																				              */
/**********************************************************************************************/
-->


<?php		
	$filename = "login_popup.js"; 
	//Parameter "r" Datei wir nur zum Lesen geöffnet
	$handle = fopen($filename, "r"); 
	$contents = fread($handle, filesize($filename)); 
	
	//Der Inhalt der 'login_popup.js' wird in der default.php ausgegeben.
	echo $contents;
		
	fclose($handle); 
?>