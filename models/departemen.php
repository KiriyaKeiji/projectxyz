<?php 
	require_once '../lib/DBClass.php';
	/**
	* 
	*/
	class Departemen extends DBClass
	{
		
		public function getDepartemen()
		{
			$sql="SELECT * FROM `departemen` where nama_departemen !='Super Admin'";
			$rs=$this->getRows($sql);
			$this->close();
			return $rs;
		}


		

	}
?>