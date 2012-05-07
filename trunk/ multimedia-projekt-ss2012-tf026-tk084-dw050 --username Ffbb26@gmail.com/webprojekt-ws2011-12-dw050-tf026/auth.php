<!--
/**********************************************************************************************/
/*			                  Source History									 		      */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Stellt eine Session anhand des Cookies und der Session ID in der DB           */
/*				wieder her.         														  */
/*--------------------------------------------------------------------------------------------*/
/*2011-12-29|TF+DW: Klasse erstellt															  */
/*																						      */
/**********************************************************************************************/
-->


<?php
	//Objekt der Klasse SQL wird erzeugt
	require_once 'sql.php';
	$sql_class = new Sql();
	//Objekt der Klasse Cookie wir erzeugt
	require_once 'cookie.php';
	$cookie_class = new Cookie();
	//Objekt der Klasse Message wir erzeugt
	require_once 'message.php';
	$message_class = new Message();	


	//COOKIE-CHECK	
	if ($_SESSION['ID'])
	{
		$username = $_SESSION['user'];
		
		$sql_SessionID = "SELECT sessionid FROM user WHERE name='$username'"; 
		
		$result = $sql_class->executeSqlQueryGetResult($sql_SessionID);
		$data = mysql_fetch_object($result);
		
		$sid = $data->sessionid;
		
		if ($sid == $_SESSION['ID'])
		{			
			echo($message_class->setUserText("Sie sind als $username eingeloggt."));
			echo("<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$('#logout_Button').show(); $('#login_Button').hide();</script>");
		}
		else
		{
			echo("<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$('#login_Button').show(); $('#logout_Button').hide();</script>");
		}
	}
	else
	{
		echo("<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$('#login_Button').show(); $('#logout_Button').hide();</script>");
	}
?>