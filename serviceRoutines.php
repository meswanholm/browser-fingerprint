<?php
	class ServiceRoutines
	{
		public function convertSpecialSign($value)
		{
			$strWss = str_replace("ö", "�", $value); //�
			$strWss = str_replace("ü", "�", $strWss); //�
			$strWss = str_replace("á", "&aacute", $strWss); //�
			
			return $strWss;
		} 
	}
?>