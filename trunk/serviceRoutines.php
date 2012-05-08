<?php
	class ServiceRoutines
	{
		public function convertSpecialSign($value)
		{
			$strWss = str_replace("รถ", "๖", $value); //๖
			$strWss = str_replace("รผ", "ü", $value); //ü
			$strWss = str_replace("รก", "&aacute", $value); //แ
			
			return $strWss;
		} 
	}
?>