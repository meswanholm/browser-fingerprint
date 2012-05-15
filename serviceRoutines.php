<!--********************************SOURCE CODE HISTORY**********************************!>
<!Coypright Till Klassen, Timo Friepes, Daniel Willinger								 !>
<!																					     !>
<!																						 !>
<!                        																 !>
<!																					     !>
<***************************************************************************************-->


<?php
	class ServiceRoutines
	{
		public function convertSpecialSign($value)
		{
			$strWss = str_replace("Ã¶", "&ouml", $value); //ö
			$strWss = str_replace("Ã¼", "&uuml", $strWss); //ü
			$strWss = str_replace("Ã¡", "&aacute", $strWss); //á
			$strWss = str_replace("ÃŸ", "&szlig", $strWss); //ß
			$strWss = str_replace("Ã¤", "&auml", $strWss); //Ä
			$strWss = str_replace("Ä", "&auml", $strWss); //ä
			$strWss = str_replace("Ã–", "&Ouml", $strWss); //Ö
			$strWss = str_replace("Ãœ", "&Uuml", $strWss); //Ü
			$strWss = str_replace("Ã©", "&eacute", $strWss); //é		
			$strWss = str_replace("â€“", "&#64", $strWss); //@
			
			return $strWss;
		} 
	}
?>