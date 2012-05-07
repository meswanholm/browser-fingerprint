<!--
/***********************************************************************************************/
/*			                  Source History									 		       */
/*---------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Löscht die Session und lädt im Element '#refresh' den jeweiligen Text neu      */
/*---------------------------------------------------------------------------------------------*/
/*2011-12-29|TF+DW: Klasse erstellt						   								       */
/*																						       */
/***********************************************************************************************/
-->


<?php
	//Objekt der Klasse Cookie wird erzeugt
	require_once 'cookie.php';
	$cookie_class = new Cookie();
	session_start();


	$name = $_SESSION['user'];

	$cookie_class->deleteSession($name);
	echo "Sie sind nicht eingeloggt.";
?>