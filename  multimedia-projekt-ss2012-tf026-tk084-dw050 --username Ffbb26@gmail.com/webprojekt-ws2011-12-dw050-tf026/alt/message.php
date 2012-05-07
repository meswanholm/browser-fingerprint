<!--
/*******************************************************************************************/
/*			                  Source History									 		   */
/*-----------------------------------------------------------------------------------------*/
/*2011-12-29|TF: Klasse erstellt und die Methode 'getJavaScriptMessage' implementiert      */
/*																						   */
/*******************************************************************************************/
-->


<?php
session_start();

	class Message
	{
		public function getJavaScriptMessage($message)
		{
			return "<script type=\"text/javascript\">alert('$message')</script>";
		} 
		
		public function setUserText($message)
		{
			return "<script type=\"text/javascript\" src=\"jquery/development-bundle/jquery-1.6.2.js\"></script><script type=\"text/javascript\">$(\"#refresh\").html(\"$message\");</script>";
		}
		
		public function createLoginOrLogoutButton()
		{		
				/*if ($_SESSION['ID'])
				{
					return ("<button id=\"logout_Button\">Logout</button>");
				}
				else 
				{*/
					return ("<button id=\"login_Button\">Login</button>");	
				//}
		}
	}
?>