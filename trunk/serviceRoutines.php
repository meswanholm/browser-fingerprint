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
			$strWss = str_replace("ö", "&ouml", $value); //�
			$strWss = str_replace("ü", "&uuml", $strWss); //�
			$strWss = str_replace("á", "&aacute", $strWss); //�
			$strWss = str_replace("ß", "&szlig", $strWss); //�
			
			return $strWss;
		} 
	}
?>