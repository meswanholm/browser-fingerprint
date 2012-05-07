<!--
/**********************************************************************************************/
/*			                  Source History									 		      */
/*--------------------------------------------------------------------------------------------*/
/*BESCHREIBUNG: Aufnahme der Datenbankverbindung.											  */
				Stellt die SQL-Verbindung zur Verfügung und führt SQL Queries aus.            */
/*--------------------------------------------------------------------------------------------*/
/*2011-12-29|TF+DW: Klasse erstellt und die Methode 'executeSqlQueryGetResult' implementiert  */
/*																						      */
/**********************************************************************************************/
-->


<?php
	class Sql
	{		
		public function Sql()
		{
			$link = mysql_connect("localhost", "dw050", "Uneec2ohza");
			
			if (!$link)
			{
				die('Could not connect: ' . mysql_error());
			}
	
			if (!mysql_select_db("u-dw050"))
			{
				die('Could not select db: ' . mysql_error());
			}
		}
		
	
		public function executeSqlQueryGetResult($query)
		{	
   			return mysql_query($query);
		}
	}
?>