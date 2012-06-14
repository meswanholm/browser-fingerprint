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
				return $value[8] . $value[9]. "." . $value[5] . $value[6] . "." . $value[0] . $value[1] . $value[2] . $value[3] . " um " . $value[11] . $value[12] . $value[13] . $value[14] . $value[15] . $value[16] . $value[17] . $value[18]; //HIER DANN UTC MIT UHRZEIT!!!
		}
		
		public function convertGenderFromEnglishToGerman($value)
		{
			if (strtoupper($value) == 'MALE')
				return "m&aumlnnlich"; 
			else if (strtoupper($value) == 'FEMALE')
				return "weiblich";
					
			return "";
		}
		
		public function translateEventTextFormEnglishToGerman($value)
		{
			if (strtoupper($value) == "UNSURE")
				return "nimmt nicht teil";
			else if (strtoupper($value) == "ATTENDING")
				return "nimmt sicher teil";
				
			//abgesagte Termine können nicht ermittelt werden.
		}
		
		public function translateRelationshipFormEnglishToGerman($value)
		{
			if (strtoupper($value) == "IN A RELATIONSHIP")
				return "In einer Beziehung";
			else if (strtoupper($value) == "SINGLE")
				return "Single";
			else if (strtoupper($value) == "ENGAGED")
				return "Verlobt";
			else if (strtoupper($value) == "MARRIED")
				return "Verheiratet";
			else if (strtoupper($value) == "IT'S COMPLICATED")
				return "Es ist kompliziert";
			else if (strtoupper($value) == "IN AN OPEN RELATIONSHIP")
				return "In einer offenen Beziehung";
			else if (strtoupper($value) == "WIDOWED")
				return "Verwitwet";
			else if (strtoupper($value) == "SEPARATED")
				return "Getrennt";
			else if (strtoupper($value) == "DIVORCED")
				return "Geschieden";
			else
				return $value;
		}
	}
?>