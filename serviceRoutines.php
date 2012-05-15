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
			$strWss = str_replace("ä", "&auml", $strWss); //�
			$strWss = str_replace("�", "&auml", $strWss); //�
			$strWss = str_replace("Ö", "&Ouml", $strWss); //�
			$strWss = str_replace("Ü", "&Uuml", $strWss); //�
			$strWss = str_replace("é", "&eacute", $strWss); //�		
			$strWss = str_replace("–", "&#64", $strWss); //@
			
			return $strWss;
		} 
	}
?>