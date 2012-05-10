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
			
			return $strWss;
		} 
	}
?>