<!--
/**********************************************************************************************/
/*			                  Source History									              */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Kontrollier Passwort/Benutzer und startet bei Login eine Session              */
/*				Übernimmt das Fehlermeldungshandling										  */
/*--------------------------------------------------------------------------------------------*/
/*2011-11-18|TF+DW: Erste Version												              */
/*2011-12-29|TF: Messageausgaben hinzugefügt									              */
/**********************************************************************************************/
-->


<?php
	//Objekt der Klasse Message wir erzeugt
	require_once 'message.php';
	$message_class = new Message();	
	//Objekt der Klasse SQL wird erzeugt
	require_once 'sql.php';
	$sql_class = new Sql();
	//Objekt der Klasse Cookie wir erzeugt
	require_once 'cookie.php';
	$cookie_class = new Cookie();
		

	//CHECK INPUT
	if(($_POST['user'] == "") OR ($_POST['password'] == ""))	
	{
		echo($message_class->getJavaScriptMessage("Keine vollstaendige Eingabe."));
		echo "Sie sind nicht eingeloggt.";
	}
	else
	{	
		//DATA TRANSFER
		//Benutzer hat sich über das Login angemeldet
		$name=mysql_real_escape_string($_POST['user']);
		$pin=mysql_real_escape_string($_POST['password']);
				
		//CHECK CHAR
		$checkname = preg_match('/[^a-zA-Z0-9-_.]/', $name);
		$checkpin =	preg_match('/[^a-zA-Z0-9-_.]/', $pin);
		
		if($checkname & $checkpin) 
		{
			echo($message_class->getJavaScriptMessage("Fehlerhafte Zeicheneingabe."));
			echo "Sie sind nicht eingeloggt.";
		}
		else
		{		
			//SQL
			$sql = "SELECT pass FROM user WHERE name='$name' AND pass='$pin'";
		
			//PIN CHECK
			$result = $sql_class->executeSqlQueryGetResult($sql);
			$data = mysql_fetch_object($result);
			$zeilenanzahl = mysql_num_rows($result);
	
			// TRUE
			if ($zeilenanzahl > 0) 
			{
				$cookie_class->startSession($name, $pin);
				echo "Sie sind als $name eingeloggt.";
				echo("<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$('#logout_Button').show(); $('#login_Button').hide();</script>");
			}
			// FALSE
			else 
			{
				echo($message_class->getJavaScriptMessage("Diese Benutzer/Passwort-Kombination gibt es nicht."));
				echo "Sie sind nicht eingeloggt.";
			}
		}
	}
	mysql_close();
?>