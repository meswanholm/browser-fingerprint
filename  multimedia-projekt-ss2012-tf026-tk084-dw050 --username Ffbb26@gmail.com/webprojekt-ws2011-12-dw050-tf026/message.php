<!--
/**********************************************************************************************/
/*			                  Source History									 		      */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Ausgabe der Alert-Box. 														  */
/*				Stellt verschiedene Message Funktionalitäten zur Verfügung                    */
/*--------------------------------------------------------------------------------------------*/
/*2011-12-29|TF+DW: Klasse erstellt und die Methode 'getJavaScriptMessage' implementiert      */
/*																						      */
/**********************************************************************************************/
-->


<?php
	class Message
	{
		//Gibt eine JavaScript Meldung aus
		public function getJavaScriptMessage($message)
		{
			return "<script type=\"text/javascript\">alert('$message')</script>";
		} 
		
		//Lädt den Text im Element '#refresh' neu
		public function setUserText($message)
		{
			return "<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$(\"#refresh\").html(\"$message\");</script>";
		}
	}
?>