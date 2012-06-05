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