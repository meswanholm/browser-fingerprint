<?php
	class ServiceRoutines
	{
		public function convertSpecialSign($value)
		{
			$strWss = str_replace("ö", "�", $value); //�
			$strWss = str_replace("ü", "�", $value); //�
			$strWss = str_replace("á", "&aacute", $value); //�
			
			return $strWss;
		} 
	}
?>