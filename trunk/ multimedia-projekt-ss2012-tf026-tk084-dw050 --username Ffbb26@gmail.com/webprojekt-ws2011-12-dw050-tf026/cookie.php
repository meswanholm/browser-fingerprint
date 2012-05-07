<!--
/*******************************************************************************************/
/*			                  Source History									 		   */
/*-----------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Startet bzw. löscht eine Session und das damit verbundene Cookie.          */
/*-----------------------------------------------------------------------------------------*/
/*2011-12-29|TF+DW: Klasse erstellt und die Methode 'startSession' implementiert           */
/*																						   */
/*******************************************************************************************/
-->


<?php
	class Cookie
	{							
		public function startSession($name, $pin)
		{
			//Objekt der Klasse SQL wird erzeugt
			require_once 'sql.php';
			$sql_class = new Sql();
			//Objekt der Klasse Message wir erzeugt
			require_once 'message.php';
			$message_class = new Message();
		
			session_start();
			$sid = session_id();
			$_SESSION['login'] = TRUE;
			$_SESSION['ID'] = session_id();
			$_SESSION['user'] = $name;
		
			$sql = "UPDATE user SET sessionid='" . session_id() . "' WHERE name='$name'";
			
			$sql_class->executeSqlQueryGetResult($sql);
		}
		
		public function deleteSession($name)
		{
			//Objekt der Klasse SQL wird erzeugt
			require_once 'sql.php';
			$sql_class = new Sql();
			
			session_start();
			
			$sql = "UPDATE user SET sessionid='' WHERE name='$name'";
			$sql_class->executeSqlQueryGetResult($sql);	

			// Löschen aller Session-Variablen.
			$_SESSION = array();
			
			// Falls die Session gelöscht werden soll, löschen Sie auch das
			// Session-Cookie.
			// Achtung: Damit wird die Session gelöscht, nicht nur die Session-Daten!
			if (ini_get("session.use_cookies")) {
			    $params = session_get_cookie_params();
			    setcookie(session_name(), '', time() - 42000, $params["path"],
			        $params["domain"], $params["secure"], $params["httponly"]
			    );
			}
			
			session_unset();
			session_destroy();
			echo("<script type=\"text/javascript\">location.reload();</script>");
		}
	}
?>