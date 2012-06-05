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
		
		public function convertUtcToGermanDate($value)
		{
			if (strlen($value) == 10) // 10/28/1987
				return $value[3] . $value[4] . "." . $value[0] . $value[1] . "." . $value[6] . $value[7] . $value[8] . $value[9];
			else if (strlen($value) == 24) // 2012-05-11T07:37:09+0000
				return "UTC"; //HIER DANN UTC MIT UHRZEIT!!!
		}
		
		public function convertGenderFromEnglishToGerman($value)
		{
			if ($value == 'male')
				return "m&aumlnnlich"; 
			else if ($value == 'female')
				return "weiblich";
					
			return "";
		}
	}
?>